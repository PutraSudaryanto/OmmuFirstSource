<?php
/**
 * User Newsletter (user-newsletter)
 * @var $this NewsletterController
 * @var $model UserNewsletter
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/mod-users
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array( 
	'id'=>'support-newsletter-form', 
	'enableAjaxValidation'=>true, 
	//'htmlOptions' => array('enctype' => 'multipart/form-data') 
)); ?>
<div class="dialog-content">
	<fieldset>		
		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('email_i');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textArea($model,'email_i',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'email_i'); ?>
			</div>
		</div>
		
		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'multiple_email_i'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'multiple_email_i'); ?>
				<?php echo $form->labelEx($model,'multiple_email_i'); ?>
				<?php echo $form->error($model,'multiple_email_i'); ?>
			</div>
		</div>
		
		<?php $model->unsubscribe_i = 0;
		echo $form->hiddenField($model,'unsubscribe_i');?>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton(Yii::t('phrase', 'Subscribe'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>

<?php $this->endWidget(); ?>
