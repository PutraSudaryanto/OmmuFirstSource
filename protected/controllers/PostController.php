<?php
/**
 * PostController
 * Handle PostController
 *
 * Reference start
 * TOC :
 *	fileUpload
 *	imageUpload
 *	imageList
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 Ommu Platform (www.ommu.co)
 * @created date 29 July 2018, 13:27 WIB
 * @link https://github.com/ommu/ommu
 *
 *----------------------------------------------------------------------------------------------------------
 */

class PostController extends Controller
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
		$arrThemes = $this->currentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(Yii::app()->createUrl('site/index'));
	}

	public function actions()
	{
		return array(
			'fileUpload'=>array(
				'class'=>'application.libraries.redactor.actions.FileUpload',
				'uploadPath'=>self::getUploadPath(),
				'uploadUrl'=>join('/', array(Yii::app()->request->baseUrl, self::getUploadPath(false))),
				'permissions'=>0755,
			),
			'imageUpload'=>array(
				'class'=>'application.libraries.redactor.actions.ImageUpload',
				'uploadPath'=>self::getUploadPath(),
				'uploadUrl'=>join('/', array(Yii::app()->request->baseUrl, self::getUploadPath(false))),
				'permissions'=>0755,
			),
			'imageList'=>array(
				'class'=>'application.libraries.redactor.actions.ImageList',
				'uploadPath'=>self::getUploadPath(),
				'uploadUrl'=>self::getUploadPath(false),
			),
		);
	}
	/**
	 * @param returnAlias set true jika ingin kembaliannya path alias atau false jika ingin string
	 * relative path. default true.
	 */ 
	public static function getUploadPath($returnAlias=true)
	{
		return ($returnAlias ? join('/', array(Yii::getPathOfAlias('webroot'), 'public/redactor')) : 'public/redactor');
	}

}