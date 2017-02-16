<?php
/**
 * Support Feedback Replies (support-feedback-reply)
 * @var $this ReplyController
 * @var $model SupportFeedbackReply
 * version: 0.2.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (ommu.co)
 * @created date 16 February 2017, 16:00 WIB
 * @link https://github.com/ommu/Support
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Support Feedback Replies'=>array('manage'),
		$model->reply_id,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'reply_id',
				'value'=>$model->reply_id,
				//'value'=>$model->reply_id != '' ? $model->reply_id : '-',
			),
			array(
				'name'=>'publish',
				'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				//'value'=>$model->publish,
			),
			array(
				'name'=>'feedback_id',
				'value'=>$model->feedback_id,
				//'value'=>$model->feedback_id != '' ? $model->feedback_id : '-',
			),
			array(
				'name'=>'reply_message',
				'value'=>$model->reply_message != '' ? $model->reply_message : '-',
				//'value'=>$model->reply_message != '' ? CHtml::link($model->reply_message, Yii::app()->request->baseUrl.'/public/visit/'.$model->reply_message, array('target' => '_blank')) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'creation_date',
				'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
			),
			array(
				'name'=>'creation_id',
				'value'=>$model->creation_id,
				//'value'=>$model->creation_id != 0 ? $model->creation_id : '-',
			),
			array(
				'name'=>'modified_date',
				'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
			),
			array(
				'name'=>'modified_id',
				'value'=>$model->modified_id,
				//'value'=>$model->modified_id != 0 ? $model->modified_id : '-',
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
