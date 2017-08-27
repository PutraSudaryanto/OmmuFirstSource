<?php
/**
 * InviteController
 * @var $this InviteController
 * @var $model UserInvites
 * @var $form CActiveForm
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *	Manage
 *	Add
 *	View
 *	RunAction
 *	Delete
 *	Publish
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/mod-users
 * @contact (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class InviteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() 
	{
		if(!Yii::app()->user->isGuest) {
			if(in_array(Yii::app()->user->level, array(1,2))) {
				$arrThemes = Utility::getCurrentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			} else
				throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		} else
			$this->redirect(Yii::app()->createUrl('site/login'));
	}

	/**
	 * @return array action filters
	 */
	public function filters() 
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() 
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('manage','add','view','runaction','delete','publish'),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level) && in_array(Yii::app()->user->level, array(1,2))',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(array('manage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionManage($user=null) 
	{
		$pageTitle = Yii::t('phrase', 'User Invites');
		if($user != null) {
			$data = Users::model()->findByPk($user);
			$pageTitle = Yii::t('phrase', 'User Invite: by $user_displayname', array ('$user_displayname'=>$data->displayname));
		}
		
		$model=new UserInvites('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserInvites'])) {
			$model->attributes=$_GET['UserInvites'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		$this->pageTitle = $pageTitle;
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_manage',array(
			'model'=>$model,
			'columns' => $columns,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd() 
	{
		$model=new UserInvites;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['UserInvites'])) {
			$model->attributes=$_POST['UserInvites'];
			if($model->multiple_email_i == 0)
				$model->scenario = 'singleEmailForm';
				
			$result = array();
			
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;

			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->multiple_email_i == 1) {
						if($model->validate()) {
							$email_i = Utility::formatFileType($model->email_i);
							$user_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : 0;
							foreach ($email_i as $email) {
								$condition = UserInvites::insertInvite($email, $user_id);
								if($condition == 0)
									$result[] = Yii::t('phrase', '$email (skip)', array('$email'=>$email));
								else if($condition == 1)
									$result[] = Yii::t('phrase', '$email (success)', array('$email'=>$email));
								else if($condition == 2)
									$result[] = Yii::t('phrase', '$email (error)', array('$email'=>$email));
							}
							echo CJSON::encode(array(
								'type' => 5,
								'get' => Yii::app()->controller->createUrl('manage'),
								'id' => 'partial-user-invites',
								'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Invite User $result success created.', array('$result'=>Utility::formatFileType($result, false))).'</strong></div>',
							));
						} else
							print_r($model->getErrors());

					} else {
						if($model->validate()) {
							$invite = UserInvites::model()->with('newsletter')->find(array(
								'select' => 't.invite_id, t.invites',
								'condition' => 't.publish = :publish AND t.user_id = :user AND newsletter.email = :email',
								'params' => array(
									':publish' => '1',
									':user' => !Yii::app()->user->isGuest ? Yii::app()->user->id : '0',
									':email' => strtolower($model->email_i),
								),
							));
							if(($invite == null && $model->save()) || ($invite != null && UserInvites::model()->updateByPk($invite->invite_id, array('code'=>UserInvites::getUniqueCode(), 'invites'=>$invite->invites+1, 'invite_ip'=>$_SERVER['REMOTE_ADDR'])))) {
								echo CJSON::encode(array(
									'type' => 5,
									'get' => Yii::app()->controller->createUrl('manage'),
									'id' => 'partial-user-invites',
									'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Invite User success.').'</strong></div>',
								));
							}
						} else
							print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
		}

		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;
		
		$this->pageTitle = Yii::t('phrase', 'Invite User');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_add',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) 
	{
		$model=$this->loadModel($id);
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;
		
		$pageTitle = Yii::t('phrase', 'View Invite: $newsletter_email by Guest', array('$newsletter_email'=>$model->newsletter->email));
		if($model->user_id)
			$pageTitle = Yii::t('phrase', 'View Invite: $newsletter_email by $inviter_displayname', array('$newsletter_email'=>$model->newsletter->email, '$inviter_displayname'=>$model->user->displayname));

		$this->pageTitle = $pageTitle;
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_view',array(
			'model'=>$model,
		));
	}	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionRunAction() {
		$id       = $_POST['trash_id'];
		$criteria = null;
		$actions  = $_GET['action'];

		if(count($id) > 0) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('invite_id', $id);

			if($actions == 'publish') {
				UserInvites::model()->updateAll(array(
					'publish' => 1,
				),$criteria);
			} elseif($actions == 'unpublish') {
				UserInvites::model()->updateAll(array(
					'publish' => 0,
				),$criteria);
			} elseif($actions == 'trash') {
				UserInvites::model()->updateAll(array(
					'publish' => 2,
				),$criteria);
			} elseif($actions == 'delete') {
				UserInvites::model()->deleteAll($criteria);
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) 
	{
		$model=$this->loadModel($id);
		
		$pageTitle = Yii::t('phrase', 'Delete Invite: $newsletter_email by Guest', array('$newsletter_email'=>$model->newsletter->email));
		if($model->user_id)
			$pageTitle = Yii::t('phrase', 'Delete Invite: $newsletter_email by $inviter_displayname', array('$newsletter_email'=>$model->newsletter->email, '$inviter_displayname'=>$model->user->displayname));
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$model->publish = 2;
			
			if($model->save()) {
				echo CJSON::encode(array(
					'type' => 5,
					'get' => Yii::app()->controller->createUrl('manage'),
					'id' => 'partial-user-invites',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'User Invite success deleted.').'</strong></div>',
				));
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = $pageTitle;
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_delete');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		
		$title = $model->publish == 1 ? Yii::t('phrase', 'Unpublish') : Yii::t('phrase', 'Publish');
		$replace = $model->publish == 1 ? 0 : 1;

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			//change value active or publish
			$model->publish = $replace;

			if($model->update()) {
				echo CJSON::encode(array(
					'type' => 5,
					'get' => Yii::app()->controller->createUrl('manage'),
					'id' => 'partial-user-invites',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'User Invite success updated.').'</strong></div>',
				));
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;
		
			$pageTitle = Yii::t('phrase', '$title Invite: $newsletter_email by Guest', array('$title'=>$title, '$newsletter_email'=>$model->newsletter->email));
			if($model->user_id)
				$pageTitle = Yii::t('phrase', '$title Invite: $newsletter_email by $inviter_displayname', array('$title'=>$title, '$newsletter_email'=>$model->newsletter->email, '$inviter_displayname'=>$model->user->displayname));

			$this->pageTitle = $pageTitle;
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_publish',array(
				'title'=>$title,
				'model'=>$model,
			));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = UserInvites::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) 
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-invites-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
