<?php
/**
 * SignupController
 * @var $this SignupController
 * version: 1.3.0
 * Reference start
 *
 * TOC :
 *	Index
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

class SignupController extends Controller
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
				'actions'=>array('index'),
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
	public function actionIndex($email=null, $token=null)
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
				$this->redirect(Yii::app()->controller->createUrl('index', array('token'=>$model->view->token_oauth)));
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
		$this->render('front_index', array(
			'model'=>$model,
			'setting'=>$setting,
			'email'=>$email,
			'token'=>$token,
		));
	}
}