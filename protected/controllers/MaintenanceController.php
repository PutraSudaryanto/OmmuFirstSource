<?php
/**
 * MaintenanceController
 * Handle MaintenanceController
 *
 * Reference start
 * TOC :
 *	Index
 *	Feedback
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/ommu
 *
 *----------------------------------------------------------------------------------------------------------
 */

class MaintenanceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize public template
	 */
	public function init() 
	{
		$setting = OmmuSettings::model()->findByPk(1,array(
			'select' => 'id',
		));

		if($setting->view->online == 0) {
			$arrThemes = Utility::getCurrentTemplate('maintenance');
			Yii::app()->theme = $arrThemes['folder'];
			$this->layout = $arrThemes['layout'];
		} else
			$this->redirect(Yii::app()->createUrl('site/index'));
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
				'actions'=>array('index','page','feedback','subscribe','support'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$setting = OmmuSettings::model()->findByPk(1,array(
			'select' => 'construction_date, construction_text',
		));

		$this->pageTitle = Yii::t('phrase', 'Contruction');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_index',array(
			'setting'=>$setting,
		));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionPage($id)
	{
		$model = OmmuPages::model()->findByPk($id,array(
			//'select' => '',
		));

		$this->pageTitle = $model->title->message;
		$this->pageDescription = Utility::shortText(Utility::hardDecode($model->description->message),300);
		$this->pageMeta = '';
		$this->pageImage = ($model->media != '' && $model->media_show == 1) ? Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->request->baseUrl.'/public/page/'.$model->media : '';
		$this->render('front_page',array(
			'model'=>$model,
		));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionFeedback()
	{
		$model=new SupportFeedbacks;
		if(!Yii::app()->user->isGuest) {
			$user = Users::model()->findByPk(Yii::app()->user->id, array(
				'select' => 'user_id, email, displayname, photos',
			));
		}

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['SupportFeedbacks'])) {
			$model->attributes=$_POST['SupportFeedbacks'];
			$model->scenario = 'contactus';

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
				
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						if($model->user_id != 0)
							$url = Yii::app()->controller->createUrl('feedback', array('email'=>$model->email, 'name'=>$model->displayname));
						else
							$url = Yii::app()->controller->createUrl('feedback', array('email'=>$model->email, 'name'=>$model->displayname));
						echo CJSON::encode(array(
							'type' => 5,
							'get' => $url,
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
			
		} else {		
			$this->pageTitle = isset($_GET['email']) ? Yii::t('phrase', 'Feedback Success') : Yii::t('phrase', 'Feedback');
			$this->pageDescription = isset($_GET['email']) ? (isset($_GET['name']) ? Yii::t('phrase', 'Hi <strong>{name} ({email})</strong>, terimakasih telah menghubungi support kami.', array('{name}'=>$_GET['name'], '{email}'=>$_GET['email'])) : Yii::t('phrase', 'Hi <strong>{email}</strong>, terimakasih telah menghubungi support kami.', array('{email}'=>$_GET['email']))) : '';
			$this->pageMeta = '';
			$this->render('front_feedback',array(
				'model'=>$model,
				'user'=>$user,
			));			
		}
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSubscribe()
	{
		$model=new UserNewsletter;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['UserNewsletter'])) {
			$model->attributes=$_POST['UserNewsletter'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
				
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						if($model->user_id == 0)
							$get = Yii::app()->controller->createUrl('subscribe', array('name'=>$model->email, 'email'=>$model->email));
						else
							$get = Yii::app()->controller->createUrl('subscribe', array('name'=>$model->user->displayname, 'email'=>$model->user->email));
						echo CJSON::encode(array(
							'type' => 5,
							'get' => $get,
						));
					} else
						print_r($model->getErrors());
				}
			}
			Yii::app()->end();
			
		} else {
			$launch = 0;
			if($launch == 0) {
				$title = (isset($_GET['name']) && isset($_GET['email'])) ? Yii::t('phrase', 'Thanks for your subscription') : Yii::t('phrase', 'Our website is under construction');
				$desc = (isset($_GET['name']) && isset($_GET['email'])) ? '' : Yii::t('phrase', 'Please enter your email to be notified of launch and to subscribe to our newsletter.');					
			} else {
				$title = (isset($_GET['name']) && isset($_GET['email'])) ? Yii::t('phrase', 'You will be notified when we launch. Thank You!') : Yii::t('phrase', 'We will be back soon!');
				$desc = (isset($_GET['name']) && isset($_GET['email'])) ? '' : Yii::t('phrase', 'Enter your email to be notified when more info is available.');			
			}
				
			$this->pageTitle = $title;
			$this->pageDescription = $desc;
			$this->pageMeta = '';
			$this->render('front_subscribe',array(
				'model'=>$model,
				'launch'=>$launch,
			));
		}
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSupport()
	{	
		$this->pageTitle = Yii::t('phrase', 'Support');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_support');
	}

	
}