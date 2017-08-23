<?php
/**
 * User Forgots (user-forgot)
 * @var $this ForgotController
 * @var $model UserForgot
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 7 August 2017, 06:43 WIB
 * @link https://github.com/ommu/mod-users
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'User Forgots'=>array('manage'),
		$model->forgot_id,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'forgot_id',
				'value'=>$model->forgot_id,
			),
			array(
				'name'=>'publish',
				'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'user_id',
				'value'=>$model->user_id ? $model->user->displayname : '-',
			),
			array(
				'name'=>'code',
				'value'=>$model->code ? $model->code : '-',
			),
			array(
				'name'=>'forgot_date',
				'value'=>!in_array($model->forgot_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->forgot_date, true) : '-',
			),
			array(
				'name'=>'forgot_ip',
				'value'=>$model->forgot_ip ? $model->forgot_ip : '-',
			),
			array(
				'name'=>'expired_date',
				'value'=>!in_array($model->expired_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->expired_date, true) : '-',
			),
			array(
				'name'=>'modified_date',
				'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
			),
			array(
				'name'=>'modified_id',
				'value'=>$model->modified_id ? $model->modified->displayname : '-',
			),
			array(
				'name'=>'deleted_date',
				'value'=>!in_array($model->deleted_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->deleted_date, true) : '-',
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>