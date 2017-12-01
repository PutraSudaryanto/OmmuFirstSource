<?php
/**
 * PasswordController
 * @var $this PasswordController
 * version: 1.3.0
 * Reference start
 *
 * TOC :
 *	Index
 *	Reset
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/ommu
 * @contact (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class PasswordController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Initialize public template
	 */
	public function init() 
	{
		Yii::import('application.vendor.ommu.users.models.*');
		Yii::import('application.vendor.ommu.users.models.view.*');

		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
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
				'actions'=>array('index','reset'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Displays the login page
	 */
	public function actionIndex()
	{
		$this->redirect(Yii::app()->createUrl('site/index'));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionReset($token=null, $success=null)
	{
		if($token == null && $success == null)
			$this->redirect(Yii::app()->createUrl('forgot/password'));

		$forgot = UserForgot::model()->findByAttributes(array('code' => $token), array(
			'select' => 'forgot_id, user_id',
		));
		
		if($success == null) {
			if($forgot != null) {
				if($forgot->view->expired == 0) {
					$model = Users::model()->findByPk($forgot->user_id);
	
					// if it is ajax validation request
					if(isset($_POST['ajax']) && $_POST['ajax']==='users-form') {
						echo CActiveForm::validate($model);
						Yii::app()->end();
					}
			
					if(isset($_POST['Users'])) {
						$model->attributes=$_POST['Users'];
						$model->scenario = 'resetPassword';
						
						if($model->save()) {
							$forgot->publish = 0;
							$forgot->modified_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : 0;

							if($forgot->update())
								$this->redirect(Yii::app()->controller->createUrl('reset',array('success'=>'true'))); 
						}
					}

					$condition = 'available';
					$pageTitle = Yii::t('phrase', 'Reset Password');
					$pageDescription = Yii::t('phrase', 'Create a new password which you will easily remember!');
	
				} else {
					$condition = 'expired';
					$pageTitle = Yii::t('phrase', 'Forgot Password Expired');
					$pageDescription = Yii::t('phrase', 'Maaf forgot password gagal, silahkan menghubungi support kami untuk informasi lebih lanjut.');
				}
			} else {
				$condition = 'novalid';
				$pageTitle = Yii::t('phrase', 'Forgot Password Not Valid');
				$pageDescription = Yii::t('phrase', 'Maaf forgot password gagal, silahkan menghubungi support kami untuk informasi lebih lanjut.');
			}
		} else {
			$condition = 'success';
			$pageTitle = Yii::t('phrase', 'Reset Password Success');
			$pageDescription = Yii::t('phrase', 'You have successfully changed your password. To sign in to your account, use your email and new password.');
		}

		$this->pageTitle = $pageTitle;
		$this->pageDescription = $pageDescription;
		$this->pageMeta = '';
		$this->render('front_reset', array(
			'model'=>$model,
			'token'=>$token,
			'condition'=>$condition,
		));
	}
}