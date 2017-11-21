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
 *	SendEmail
 *	Analytics
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/core
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
		Utility::applyViewPath(__dir__);
		//$this->pageGuest = true;
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
			'select' => 'online, construction_date',
		));
		//$this->redirect(Yii::app()->createUrl('project/site/index'));

		if(($setting->online == 0 && date('Y-m-d', strtotime($setting->construction_date)) > date('Y-m-d')) && (Yii::app()->user->isGuest || (!Yii::app()->user->isGuest && in_array(!Yii::app()->user->level, array(1,2))))) {
			$this->redirect(Yii::app()->createUrl('maintenance/index'));

		} else {
			/* if(!Yii::app()->user->isGuest) {
				$this->redirect(Yii::app()->createUrl('pose/site/index'));
			} else {
				$render = 'front_index';
			} */
			
			$this->sidebarShow = false;
			$this->pageTitle = Yii::t('phrase', 'Home');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('front_index', array(
				'setting'=>$setting,
			));
			
		}
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$setting = OmmuSettings::model()->findByPk(1, array(
			'select'=>'site_type',
		));
		
		if(!Yii::app()->user->isGuest)
			$this->redirect(array('site/index'));

		else {
			if($setting->site_type == 1)
				$this->redirect(Yii::app()->createUrl('users/account'));
			else
				$this->redirect(Yii::app()->createUrl('users/admin'));
		}
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