<?php
/**
 * Support Feedback Views (support-feedback-view)
 * @var $this ViewsController
 * @var $model SupportFeedbackView
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 11 May 2017, 23:13 WIB
 * @link https://github.com/ommu/mod-support
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Support Feedback Views'=>array('manage'),
		$model->view_id,
	);
?>

<div class="dialog-content">
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
				'name'=>'subject_search',
				'value'=>$model->feedback->subject ? $model->feedback->subject : '-',
			),
			array(
				'name'=>'message_i',
				'value'=>$model->feedback->message ? $model->feedback->message : '-',
			),
			array(
				'name'=>'user_id',
				'value'=>$model->user_id != 0 ? $model->user->displayname : '-',
			),
			array(
				'name'=>'view_date',
				'value'=>!in_array($model->view_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->view_date, true) : '-',
			),
			array(
				'name'=>'user_id',
				'value'=>$model->view_ip ? $model->view_ip : '-',
			),
			array(
				'name'=>'modified_date',
				'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
			),
			array(
				'name'=>'modified_id',
				'value'=>$model->modified_id != 0 ? $model->modified->displayname : '-',
			),
			array(
				'name'=>'updated_date',
				'value'=>!in_array($model->updated_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->updated_date, true) : '-',
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
