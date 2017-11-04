<?php
/**
 * ZonedistrictController
 * @var $this ZonedistrictController
 * @var $model OmmuZoneDistricts
 * @var $form CActiveForm
 * version: 1.3.0
 * Reference start
 *
 * TOC :
 *	Index
 *	Manage
 *	Add
 *	Edit
 *	RunAction
 *	Delete
 *	Publish
 *	Suggest
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2015 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class ZonedistrictController extends Controller
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
		if(!Yii::app()->user->isGuest) {
			if(in_array(Yii::app()->user->level, array(1,2))) {
				$arrThemes = Utility::getCurrentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
				Utility::applyViewPath(__dir__);
			} else
				throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		} else {
			$arrThemes = Utility::getCurrentTemplate('public');
			Yii::app()->theme = $arrThemes['folder'];
			$this->layout = $arrThemes['layout'];
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
				'actions'=>array('suggest'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','manage','add','edit','runaction','delete','publish'),
				'users'=>array('@'),
				'expression'=>'$user->level == 1',
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
		$this->redirect(array('manage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionManage() 
	{
		$model=new OmmuZoneDistricts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OmmuZoneDistricts'])) {
			$model->attributes=$_GET['OmmuZoneDistricts'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		$this->pageTitle = Yii::t('phrase', 'Districts');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('/zone_district/admin_manage',array(
			'model'=>$model,
			'columns' => $columns,
		));
	}	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd() 
	{
		$model=new OmmuZoneDistricts;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['OmmuZoneDistricts'])) {
			$model->attributes=$_POST['OmmuZoneDistricts'];
			
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;

			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 5,
							'get' => Yii::app()->controller->createUrl('manage'),
							'id' => 'partial-ommu-zone-districts',
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Districts success created.').'</strong></div>',
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
			
		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 600;

			$this->pageTitle = Yii::t('phrase', 'Create District');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('/zone_district/admin_add',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id) 
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['OmmuZoneDistricts'])) {
			$model->attributes=$_POST['OmmuZoneDistricts'];
			
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;

			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 5,
							'get' => Yii::app()->controller->createUrl('manage'),
							'id' => 'partial-ommu-zone-districts',
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Districts success updated.').'</strong></div>',
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
			
		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 600;

			$this->pageTitle = Yii::t('phrase', 'Update District: $district_name', array('$district_name'=>$model->district_name));
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('/zone_district/admin_edit',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionRunAction() {
		$id       = $_POST['trash_id'];
		$criteria = null;
		$actions  = $_GET['action'];

		if(count($id) > 0) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('id', $id);

			if($actions == 'publish') {
				OmmuZoneDistricts::model()->updateAll(array(
					'publish' => 1,
				),$criteria);
			} elseif($actions == 'unpublish') {
				OmmuZoneDistricts::model()->updateAll(array(
					'publish' => 0,
				),$criteria);
			} elseif($actions == 'trash') {
				OmmuZoneDistricts::model()->updateAll(array(
					'publish' => 2,
				),$criteria);
			} elseif($actions == 'delete') {
				OmmuZoneDistricts::model()->deleteAll($criteria);
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) 
	{
		$model=$this->loadModel($id);
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$model->publish = 2;
			
			if($model->save()) {
				echo CJSON::encode(array(
					'type' => 5,
					'get' => Yii::app()->controller->createUrl('manage'),
					'id' => 'partial-ommu-zone-districts',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Districts success deleted.').'</strong></div>',
				));
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = Yii::t('phrase', 'Delete District: $district_name', array('$district_name'=>$model->district_name));
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('/zone_district/admin_delete');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		
		$title = $model->publish == 1 ? Yii::t('phrase', 'Unpublish') : Yii::t('phrase', 'Publish');
		$replace = $model->publish == 1 ? 0 : 1;

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			//change value active or publish
			$model->publish = $replace;

			if($model->update()) {
				echo CJSON::encode(array(
					'type' => 5,
					'get' => Yii::app()->controller->createUrl('manage'),
					'id' => 'partial-ommu-zone-districts',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Districts success updated.').'</strong></div>',
				));
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = Yii::t('phrase', '$title District: $district_name', array('$title'=>$title, '$district_name'=>$model->district_name));
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('/zone_district/admin_publish',array(
				'title'=>$title,
				'model'=>$model,
			));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionSuggest($id=null, $limit=10) 
	{
		if($id == null) {
			if(isset($_GET['term'])) {
				$criteria = new CDbCriteria;
				$criteria->select = "district_id, city_id, district_name";
				$criteria->condition = 'district_name LIKE :district';
				$criteria->params = array(':district' => '%' . strtolower($_GET['term']) . '%');
				$criteria->order = "district_name ASC";
				$criteria->limit = $limit;
				$model = OmmuZoneDistricts::model()->findAll($criteria);

				if($model) {
					foreach($model as $items) {
						$result[] = array(
							'id' => $items->district_id, 
							'value' => $items->district_name,
							'city_id' => $items->city->city_id,
							'city_name' => $items->city->city_name,
							'province_id' => $items->city->province->province_id,
							'province_name' => $items->city->province->province_name,
							'country_id' => $items->city->province->country->country_id,
							'country_name' => $items->city->province->country->country_name,
						);
					}
				}
			}
			echo CJSON::encode($result);
			Yii::app()->end();
			
		} else {
			$model = OmmuZoneDistricts::getDistrict($id);
			$message['data'] = '<option value="">'.Yii::t('phrase', 'Select one').'</option>';
			foreach($model as $key => $val) {
				$message['data'] .= '<option value="'.$key.'">'.$val.'</option>';
			}
			echo CJSON::encode($message);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = OmmuZoneDistricts::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ommu-zone-districts-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
