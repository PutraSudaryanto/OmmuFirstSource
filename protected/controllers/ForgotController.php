<?php
/**
 * ForgotController
 * @var $this ForgotController
 * version: 1.3.0
 * Reference start
 *
 * TOC :
 *	Index
 *	Password
 *	Username
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

class ForgotController extends Controller
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

		unset(Yii::app()->session['reset_user_token']);
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
				'actions'=>array('index','password','username'),
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
	public function actionPassword($token=null)
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
				$this->redirect(Yii::app()->controller->createUrl('password', array('token'=>$model->user->view->token_oauth)));
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
		$this->render('front_password', array(
			'model'=>$model,
			'token'=>$token,
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