<?php
/**
 * Ommu Pages (ommu-pages)
 * @var $this OmmuPagesController
 * @var $model OmmuPages
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (www.ommu.co)
 * @link https://github.com/ommu/ommu
 *
 */
 
	$this->breadcrumbs=array(
		'Ommu Pages'=>array('manage'),
		$model->name,
	);
?>

<?php if(($a == null && $model->media_show == 1) || ($a != null && $model->media_show == 'show')) {
	if($a == null)
		$images = Yii::app()->request->baseUrl.'/public/page/'.$model->media;
	else
		$images = $model->media_image;
		
	if($this->sidebarShow == true) {
		if(($a == null && $model->media_type == 1) || ($a != null && $model->media_type == 'large'))
			echo '<img class="largemag" src="'.Utility::getTimThumb($images, 600, 900, 3).'" alt="'.$model->title->message.'">';
		else
			echo '<img class="mediummag" src="'.Utility::getTimThumb($images, 270, 500, 3).'" alt="'.$model->title->message.'">';
	} else {
		if(($a == null && $model->media_type == 1) || ($a != null && $model->media_type == 'large'))
			echo '<img class="largemag" src="'.Utility::getTimThumb($images, 1280, 1024, 3).'" alt="'.$model->title->message.'">';
		else
			echo '<img class="mediummag" src="'.Utility::getTimThumb($images, 270, 500, 3).'" alt="'.$model->title->message.'">';
	}
}?>

<?php if($a == null)
	echo $model->title->message != Utility::hardDecode($model->description->message) ? Utility::cleanImageContent($model->description->message) : '';
else 
	echo $model->description;?>