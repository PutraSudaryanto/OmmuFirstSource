<?php
/**
 * SiteController
 * @var $this SiteController
 * version: 1.3.0
 * Reference start
 *
 * TOC :
 *	Error
 *	Index
 *	Login
 *	Logout
 *	Analytics
 *	SendEmail
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

class SiteController extends Controller
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
				'actions'=>array('error','index','login','logout','analytics','sendemail'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->pageGuest = true;
		$this->sidebarShow = false;
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('front_error', $error);
		} else {
			$this->render('front_error', $error);
		}
		Reports::insertReport($this->pageURL, $error['message']);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$setting = OmmuSettings::model()->findByPk(1,array(
			'select' => 'id, online',
		));

		if($setting->view->online == 0 && (Yii::app()->user->isGuest || (!Yii::app()->user->isGuest && in_array(!Yii::app()->user->level, array(1,2))))) {
			if($setting->online == 0)
				$this->redirect(Yii::app()->createUrl('maintenance/index'));
			else if($setting->online == 2)
				$this->redirect(Yii::app()->createUrl('comingsoon/index'));

		} else {
			$this->sidebarShow = false;
			$this->pageTitle = Yii::t('phrase', 'Home');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('front_index');
		}
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin($token=null)
	{
		Yii::import('application.vendor.ommu.users.models.*');
		Yii::import('application.vendor.ommu.users.models.view.*');
		
		$setting = OmmuSettings::model()->findByPk(1, array(
			'select'=>'site_oauth, site_type',
		));
		
		if(!Yii::app()->user->isGuest)
			$this->redirect(array('site/index'));

		$condition = true;
		$model=new LoginForm;
		$modelForm = 'LoginForm';
		if($setting->site_type == 0 || $setting->site_oauth == 1) {
			$condition = false;
			$model=new LoginFormAdmin;
			$modelForm = 'LoginFormAdmin';
			if($setting->site_oauth == 1) {
				$model=new LoginFormOauth;
				$modelForm = 'LoginFormOauth';
			}
		}

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST[$modelForm]))
		{
			$model->attributes=$_POST[$modelForm];

			if($condition == true) {
				if($token == null) {
					$model->scenario = 'loginemail';

					if($model->email != '') {
						if(preg_match('/@/',$model->email)) //$this->username can filled by username or email
							$user = Users::model()->findByAttributes(array('email' => strtolower($model->email)));
						else 
							$user = Users::model()->findByAttributes(array('username' => strtolower($model->email)));

						if($user == null)
							$this->redirect(Yii::app()->createUrl('account/signup', array('email'=>$model->email)));
						else
							$this->redirect(Yii::app()->controller->createUrl('login', array('token'=>$user->view->token_oauth)));
					} else
						$model->addError('email', Yii::t('phrase', 'Email cannot be blank.'));

				} else {
					$model->scenario = 'loginpassword';

					// validate user input and redirect to the previous page if valid
					if($model->validate() && $model->login()) {
						Users::model()->updateByPk(Yii::app()->user->id, array(
							'lastlogin_date'=>date('Y-m-d H:i:s'), 
							'lastlogin_ip'=>$_SERVER['REMOTE_ADDR'],
							'lastlogin_from'=>Yii::app()->params['product_access_system'],
						));
		
						$this->redirect(Yii::app()->user->returnUrl);
					}
				}

			} else {
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login()) {
					Users::model()->updateByPk(Yii::app()->user->id, array(
						'lastlogin_date'=>date('Y-m-d H:i:s'), 
						'lastlogin_ip'=>$_SERVER['REMOTE_ADDR'],
						'lastlogin_from'=>Yii::app()->params['product_access_system'],
					));
	
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}
		
		$this->pageTitle = Yii::t('phrase', 'Login');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_login', array(
			'model'=>$model,
			'condition'=>$condition,
			'setting'=>$setting,
			'token'=>$token,
		));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAnalytics()
	{
		$model = OmmuSettings::model()->findByPk(1,array(
			'select' => 'site_url, analytic, analytic_id, analytic_profile_id',
		));
		
		$this->pageTitleShow = true;		
		$this->pageTitle = Yii::t('phrase', 'Statistic');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_analytics', array(
			'model'=>$model,
		));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionSendEmail($email='putra.sudaryanto@gmail.com', $name='Putra Sudaryanto', $subject='testing', $message='testing')
	{
		if(SupportMailSetting::sendEmail($email, $name, $subject, $message))
			echo 'send';
		else 
			echo 'notsend';
	}
}