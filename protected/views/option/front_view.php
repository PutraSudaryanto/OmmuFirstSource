<?php
/**
 * Ommu Options (ommu-options)
 * @var $this OptionController
 * @var $model OmmuOptions
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 17 March 2017, 10:49 WIB
 * @link https://github.com/ommu/Core
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Options'=>array('manage'),
		$model->option_id,
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
			'name'=>'option_id',
			'value'=>$model->option_id,
			//'value'=>$model->option_id != '' ? $model->option_id : '-',
		),
		array(
			'name'=>'autoload',
			'value'=>$model->autoload,
			//'value'=>$model->autoload != '' ? $model->autoload : '-',
		),
		array(
			'name'=>'option_type',
			'value'=>$model->option_type,
			//'value'=>$model->option_type != '' ? $model->option_type : '-',
		),
		array(
			'name'=>'option_name',
			'value'=>$model->option_name,
			//'value'=>$model->option_name != '' ? $model->option_name : '-',
		),
		array(
			'name'=>'option_value',
			'value'=>$model->option_value,
			//'value'=>$model->option_value != '' ? $model->option_value : '-',
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

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
