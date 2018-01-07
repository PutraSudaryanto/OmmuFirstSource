<?php
/**
 * AdminController
 * @var $this AdminController
 *
 * Reference start
 * TOC :
 *	Index
 *	Dashboard
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

class AdminController extends Controller
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
		$setting = OmmuSettings::model()->findByPk(1, array(
			'select'=>'site_type',
		));
		
		if(!Yii::app()->user->isGuest) {
			if(in_array(Yii::app()->user->level, array(1,2))) {
				$arrThemes = Utility::getCurrentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			}
		} else {
			if($setting->site_type == 1)
				$this->redirect(Yii::app()->createUrl('site/login'));
			else
				$this->redirect(Yii::app()->createUrl('users/admin'));
		}
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','dashboard'),
				'users'=>array('@'),
				'expression'=>'in_array($user->level, array(1,2))',
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
		$this->redirect(array('dashboard'));
	}

	/**
	 * Manages all models.
	 */
	public function actionDashboard() 
	{
		/* Wall Post */
		$model=new OmmuWalls;

		/* Get Walll */
		$criteria=new CDbCriteria; 
		$criteria->condition = 'publish = :publish'; 
		$criteria->params = array(':publish'=>1); 
		$criteria->order = 'creation_date DESC'; 

		$dataProvider = new CActiveDataProvider('OmmuWalls', array( 
			'criteria'=>$criteria, 
			'pagination'=>array( 
				'pageSize'=>5, 
			), 
		));
		
		$data = '';
		$wall = $dataProvider->getData();
		if(!empty($wall)) {
			foreach($wall as $key => $item) {
				$data .= Utility::otherDecode($this->renderPartial('/wall/_view', array('data'=>$item), true, false));
			}
		}
		$pager = OFunction::getDataProviderPager($dataProvider);
		if($pager[nextPage] != '0') {
			$summaryPager = 'Displaying 1-'.($pager[currentPage]*$pager[pageSize]).' of '.$pager[itemCount].' results.';
		} else {
			$summaryPager = 'Displaying 1-'.$pager[itemCount].' of '.$pager[itemCount].' results.';
		}
		$nextPager = $pager['nextPage'] != 0 ? Yii::app()->createUrl('wall/get', array($pager['pageVar']=>$pager['nextPage'])) : 0;
		
		$this->pageTitle = Yii::t('phrase', 'Welcome, $displayname', array('$displayname'=>Yii::app()->user->displayname));
		$this->pageDescription = Yii::t('phrase', 'Welcome to your social network control panel. Here you can manage and modify every aspect of your social network. Directly below, you will find a quick snapshot of your social network including some useful statistics.');
		$this->pageMeta = '';
		$this->render('admin_dashboard', array(
			'model'=>$model,			
			'data'=>$data,
			'pager'=>$pager,
			'summaryPager'=>$summaryPager,
			'nextPager'=>$nextPager,
		));
	}	
}
