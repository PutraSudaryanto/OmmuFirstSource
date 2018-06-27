<?php
/**
 * MaintenanceController
 * Handle MaintenanceController
 *
 * Reference start
 * TOC :
 *	Index
 *	Page
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
		$model = OmmuPages::model()->findByPk($id);

		$this->pageTitle = $model->title->message;
		$this->pageDescription = Utility::shortText(Utility::hardDecode($model->description->message),300);
		$this->pageMeta = '';
		$this->pageImage = ($model->media != '' && $model->media_show == 1) ? Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->request->baseUrl.'/public/page/'.$model->media : '';
		$this->render('front_page',array(
			'model'=>$model,
		));
	}
}