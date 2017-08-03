<?php
/**
 * Ommu Page Views (ommu-page-views)
 * @var $this ViewController
 * @var $model OmmuPageViews
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 4 August 2017, 06:11 WIB
 * @link http://opensource.ommu.co
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Page Views'=>array('manage'),
		$model->view_id,
	);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>

<?php $this->widget('application.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'view_id',
			'value'=>$model->view_id,
		),
		array(
			'name'=>'publish',
			'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			'type'=>'raw',
		),
		array(
			'name'=>'page_id',
			'value'=>$model->page_id,
			//'value'=>$model->page_id ? $model->page_id : '-',
		),
		array(
			'name'=>'user_id',
			'value'=>$model->user_id ? $model->user->displayname : '-',
		),
		array(
			'name'=>'views',
			'value'=>$model->views,
			//'value'=>$model->views ? $model->views : '-',
		),
		array(
			'name'=>'view_date',
			'value'=>!in_array($model->view_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->view_date, true) : '-',
		),
		array(
			'name'=>'view_ip',
			'value'=>$model->view_ip,
			//'value'=>$model->view_ip ? $model->view_ip : '-',
		),
		array(
			'name'=>'deleted_date',
			'value'=>!in_array($model->deleted_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->deleted_date, true) : '-',
		),
	),
)); ?>

<div class="box">
</div>
<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>