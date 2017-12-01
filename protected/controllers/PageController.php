<?php
/**
 * PageController
 * Handle PageController
 * version: 1.3.0
 * Reference start
 *
 * TOC :
 *	Index
 *	View
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

class PageController extends Controller
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
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
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
		$this->redirect(array('view'));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id=null, $static=null, $picture=null)
	{
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
		Utility::applyCurrentTheme($this->module);
		
		//$this->pageGuest = true;
		
		if($id == null) {
			$criteria=new CDbCriteria;
			$criteria->condition = 'publish = :publish';
			$criteria->params = array(':publish'=>1);
			$criteria->order = 'creation_date DESC';

			$dataProvider = new CActiveDataProvider('OmmuPages', array(
				'criteria'=>$criteria,
				'pagination'=>array(
					'pageSize'=>10,
				),
			));

			$this->pageTitle = Yii::t('phrase', 'Pages');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('front_index',array(
				'dataProvider'=>$dataProvider,
			));
			
		} else {
			if($static == null) {
				$model=$this->loadModel($id);
				
				$title = $model->title->message;
				$description = $model->description->message;
				$image = ($model->media != '' && $model->media_show == 1) ? Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->request->baseUrl.'/public/page/'.$model->media : '';
				
			} else {
				$server = Utility::getConnected(Yii::app()->params['server_options']['bpad']);
				if($server != 'neither-connected') {
					if(in_array($server, Yii::app()->params['server_options']['localhost']))
						$server = $server.'/bpadportal';			
					$url = $server.preg_replace('('.Yii::app()->request->baseUrl.')', '', Yii::app()->createUrl('api/page/detail'));
					
					$item = array(
						'id' => $id,
					);
					$items = http_build_query($item);
				
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					//curl_setopt($ch,CURLOPT_HEADER, true);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $items);
					$output=curl_exec($ch);	

					$model = json_decode($output);
				}
				
				$title = $model->success == '0' ? 'Page not found' : $model->title;
				$description = $model->success == '0' ? '' : $model->description;
				$image = $model->success == '0' ? '' : ($model->media_image != '-') ? $model->media_image : '';
			}
			
			if(($static == null && $model == null) || ($static != null && $model->success == '0'))
				throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
			
			$this->pageTitleShow = true;
			$this->pageTitle = $title;
			$this->pageDescription = Utility::shortText(Utility::hardDecode($description), 200);
			$this->pageMeta = '';
			$this->pageImage = $image;
			$this->render('front_view',array(
				'model'=>$model,
				'static'=>$static,
				'picture'=>$picture,
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
		$model = OmmuPages::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ommu-pages-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
