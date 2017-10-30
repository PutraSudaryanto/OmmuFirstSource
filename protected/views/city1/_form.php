<?php
/**
 * Core Zone Cities (core-zone-city)
 * @var $this City1Controller
 * @var $model CoreZoneCity
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 30 October 2017, 15:18 WIB
 * @link http://opensource.ommu.co
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'core-zone-city-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<?php //begin.Messages ?>
<div id="ajax-message">
	<?php echo $form->errorSummary($model); ?>
</div>
<?php //begin.Messages ?>

<fieldset>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'province_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'province_id'); ?>
			<?php echo $form->error($model,'province_id'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'city_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'city_name',array('size'=>60,'maxlength'=>64)); ?>
			<?php echo $form->error($model,'city_name'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'mfdonline'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'mfdonline',array('size'=>4,'maxlength'=>4)); ?>
			<?php echo $form->error($model,'mfdonline'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'publish'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'publish'); ?>
			<?php echo $form->labelEx($model,'publish'); ?>
			<?php echo $form->error($model,'publish'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'checked'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'checked'); ?>
			<?php echo $form->labelEx($model,'checked'); ?>
			<?php echo $form->error($model,'checked'); ?>
		</div>
	</div>

	<?php /*
	<div class="submit clearfix">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton(\$model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
		</div>
	</div>
	*/?>

</fieldset>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>