<?php
/**
 * AccountController
 * @var $this AccountController
 *
 * Reference start
 * TOC :
 *	Index
 *	Signup
 *	Forgot
 *	Reset
 *	Verify
 *	Email
 *	Username
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

class AccountController extends Controller
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
				'actions'=>array('signup','forgot','reset','verify','email','username'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('@'),
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
	public function actionSignup($email=null, $token=null)
	{
		$setting = OmmuSettings::model()->findByPk(1, array(
			'select'=>'site_title, signup_approve, signup_verifyemail, signup_random',
		));
		
		if(!Yii::app()->user->isGuest)
			$this->redirect(array('site/index'));
		
		$model=new Users;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->scenario = 'formAdd';

			if($model->save()) {
				$this->redirect(Yii::app()->controller->createUrl('signup', array('token'=>$model->view->token_oauth)));
			}
		}

		if($token == null) {
			$pageTitle = Yii::t('phrase', 'Sign Up');
			$pageDescription = Yii::t('phrase', 'Register a new membership');
			
		} else {
			$user = ViewUsers::model()->findByAttributes(array('token_oauth' => $token));
			$pageTitle = Yii::t('phrase', 'Sign Up Success');
			$pageDescription = Yii::t('phrase', 'Hi, <strong>{displayname}</strong> terimakasih sudah mendaftar akun {site_title}.<br/>Informasi akun sudah dikirimkan ke email <strong>{email}</strong>.', array(
				'{site_title}' => $setting->site_title,
				'{displayname}' => $user->user->displayname,
				'{email}' => $user->user->email,
			));
			if($setting->signup_verifyemail == 1 && $setting->signup_random != 1) {
				$pageDescription = Yii::t('phrase', 'Hi, <strong>{displayname}</strong> terimakasih sudah mendaftar akun {site_title}.<br/>Email verifikasi sudah dikirimkan ke email <strong>{email}</strong>', array(
					'{site_title}' => $setting->site_title,
					'{displayname}' => $user->user->displayname,
					'{email}' => $user->user->email,
				));
			}
		}
		$this->pageTitle = $pageTitle;
		$this->pageDescription = $pageDescription;
		$this->pageMeta = '';
		$this->render('front_signup', array(
			'model'=>$model,
			'setting'=>$setting,
			'email'=>$email,
			'token'=>$token,
		));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionForgot($token=null)
	{
		$model=new UserForgot;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-forgot-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['UserForgot']))
		{
			$model->attributes=$_POST['UserForgot'];
			$model->scenario = 'getForm';

			if($model->save()) {
				$this->redirect(Yii::app()->controller->createUrl('forgot', array('token'=>$model->user->view->token_oauth)));
			}
		}

		if($token == null) {
			$pageTitle = Yii::t('phrase', 'Forgot Password?');
			$pageDescription = Yii::t('phrase', 'Enter your email address or username and we\'ll send you instructions to reset your password.');
			
		} else {
			$user = ViewUsers::model()->findByAttributes(array('token_oauth' => $token));
			$pageTitle = Yii::t('phrase', 'Forgot Password?');
			$pageDescription = Yii::t('phrase', 'Hi, <strong>{displayname}</strong> an email with instructions for creating a new password has been sent to <strong>{email}</strong>', array(
				'{displayname}' => $user->user->displayname,
				'{email}' => $user->user->email,
			));
		}

		$this->pageTitle = $pageTitle;
		$this->pageDescription = $pageDescription;
		$this->pageMeta = '';
		$this->render('front_forgot', array(
			'model'=>$model,
			'token'=>$token,
		));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionReset($token=null, $success=null)
	{
		if($token == null && $success == null)
			$this->redirect(Yii::app()->controller->createUrl('forgot'));

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
	
	/**
	 * Displays the login page
	 */
	public function actionVerify($token=null)
	{
		$model=new UserVerify;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-verify-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['UserVerify']))
		{
			$model->attributes=$_POST['UserVerify'];
			$model->scenario = 'getForm';

			if($model->save()) {
				$this->redirect(Yii::app()->controller->createUrl('verify', array('token'=>$model->user->view->token_oauth)));
			}
		}

		if($token == null) {
			$pageTitle = Yii::t('phrase', 'Verify Account?');
			$pageDescription = Yii::t('phrase', 'Enter your email address or username and we\'ll send you instructions to verify your account.');
			
		} else {
			$user = ViewUsers::model()->findByAttributes(array('token_oauth' => $token));
			$pageTitle = Yii::t('phrase', 'Verify Account?');
			$pageDescription = Yii::t('phrase', 'Hi, <strong>{displayname}</strong> an email with instructions for verify your account has been sent to <strong>{email}</strong>', array(
				'{displayname}' => $user->user->displayname,
				'{email}' => $user->user->email,
			));
		}

		$this->pageTitle = $pageTitle;
		$this->pageDescription = $pageDescription;
		$this->pageMeta = '';
		$this->render('front_verify', array(
			'model'=>$model,
			'token'=>$token,
		));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionEmail($token=null, $success=null)
	{
		if($token == null && $success == null)
			$this->redirect(Yii::app()->controller->createUrl('verify'));

		$verify = UserVerify::model()->findByAttributes(array('code' => $token), array(
			'select' => 'verify_id, user_id',
		));
		
		if($success == null) {
			if($verify != null) {
				if($verify->view->expired == 0) {
					$model = Users::model()->findByPk($verify->user_id, array(
						'select' => 'user_id, email, displayname',
					));
					$model->verified = 1;
					
					if($model->update()) {
						$verify->publish = 0;
						$verify->modified_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : 0;

						if($verify->update())
							$this->redirect(Yii::app()->controller->createUrl('email',array('success'=>'true')));
					}

					$condition = 'available';
					$pageTitle = Yii::t('phrase', 'Reset Password');
					$pageDescription = Yii::t('phrase', 'Create a new password which you will easily remember!');
	
				} else {
					$condition = 'expired';
					$pageTitle = Yii::t('phrase', 'Verify Account Expired');
					$pageDescription = Yii::t('phrase', 'Maaf verify account gagal, silahkan menghubungi support kami untuk informasi lebih lanjut.');
				}
			} else {
				$condition = 'novalid';
				$pageTitle = Yii::t('phrase', 'Verify Account Not Valid');
				$pageDescription = Yii::t('phrase', 'Maaf verify account gagal, silahkan menghubungi support kami untuk informasi lebih lanjut.');
			}
		} else {
			$condition = 'success';
			$pageTitle = Yii::t('phrase', 'Verify Account Success');
			$pageDescription = Yii::t('phrase', 'You have successfully verify account. To sign in to your account, use your email and password.');
		}

		$this->pageTitle = $pageTitle;
		$this->pageDescription = $pageDescription;
		$this->pageMeta = '';
		$this->render('front_email', array(
			'model'=>$model,
			'token'=>$token,
			'condition'=>$condition,
		));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionUsername()
	{
		$model=new Users;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];

			if($model->save()) {
				$this->redirect(Yii::app()->createUrl('signup/index', array('token'=>$model->view->token_oauth)));
			}
		}

		$this->pageTitle = Yii::t('phrase', 'Forgot Username');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_username');
	}
}