<?php
/**
 * User Settings (user-setting)
 * @var $this SettingController
 * @var $model UserSetting
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 10 August 2017, 13:50 WIB
 * @link @link https://github.com/ommu/mod-users
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'user-setting-form',
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
			<label>
				<?php echo $model->getAttributeLabel('license');?> <span class="required">*</span><br/>
				<span><?php echo Yii::t('phrase', 'Enter the your license key that is provided to you when you purchased this plugin. If you do not know your license key, please contact support team.');?></span>
			</label>
			<div class="desc">
				<?php 
				if($model->isNewRecord || (!$model->isNewRecord && $model->license == ''))
					$model->license = UserSetting::getLicense();
			
				if($model->isNewRecord || (!$model->isNewRecord && $model->license == ''))
					echo $form->textField($model,'license',array('maxlength'=>32,'class'=>'span-4'));
				else
					echo $form->textField($model,'license',array('maxlength'=>32,'class'=>'span-4','disabled'=>'disabled'));?>
				<?php echo $form->error($model,'license'); ?>
				<span class="small-px"><?php echo Yii::t('phrase', 'Format: XXXX-XXXX-XXXX-XXXX');?></span>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'permission'); ?>
			<div class="desc">
				<span class="small-px"><?php echo Yii::t('phrase', 'Select whether or not you want to let the public (visitors that are not logged-in) to view the following sections of your social network. In some cases (such as Profiles, Blogs, and Albums), if you have given them the option, your users will be able to make their pages private even though you have made them publically viewable here. For more permissions settings, please visit the General Settings page.');?></span>
				<?php 
				if($model->isNewRecord && !$model->getErrors())
					$model->permission = 1;
				echo $form->radioButtonList($model, 'permission', array(
					1 => Yii::t('phrase', 'Yes, the public can view articles unless they are made private.'),
					0 => Yii::t('phrase', 'No, the public cannot view articles.'),
				)); ?>
				<?php echo $form->error($model,'permission'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'meta_description'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'meta_description',array('rows'=>6, 'cols'=>50, 'class'=>'span-7 smaller')); ?>
				<?php echo $form->error($model,'meta_description'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'meta_keyword'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'meta_keyword',array('rows'=>6, 'cols'=>50, 'class'=>'span-7 smaller')); ?>
				<?php echo $form->error($model,'meta_keyword'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'forgot_difference'); ?>
			<div class="desc">
				<div>
					<?php 
					if($model->isNewRecord && !$model->getErrors())
						$model->forgot_diff_type = 0;
					echo $form->dropDownList($model, 'forgot_diff_type', array(
						1 => Yii::t('phrase', 'Hour'),
						0 => Yii::t('phrase', 'Day'),
					)); ?>
					<?php echo $form->textField($model,'forgot_difference', array('maxlength'=>2,'class'=>'span-2')); ?>
				</div>
				<?php echo $form->error($model,'forgot_difference'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'verify_difference'); ?>
			<div class="desc">
				<div>
					<?php 
					if($model->isNewRecord && !$model->getErrors())
						$model->verify_diff_type = 0;
					echo $form->dropDownList($model, 'verify_diff_type', array(
						1 => Yii::t('phrase', 'Hour'),
						0 => Yii::t('phrase', 'Day'),
					)); ?>
					<?php echo $form->textField($model,'verify_difference', array('maxlength'=>2,'class'=>'span-2')); ?>
				</div>
				<?php echo $form->error($model,'verify_difference'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'invite_difference'); ?>
			<div class="desc">
				<div>
					<?php 
					if($model->isNewRecord && !$model->getErrors())
						$model->invite_diff_type = 0;
					echo $form->dropDownList($model, 'invite_diff_type', array(
						1 => Yii::t('phrase', 'Hour'),
						0 => Yii::t('phrase', 'Day'),
					)); ?>
					<?php echo $form->textField($model,'invite_difference', array('maxlength'=>2,'class'=>'span-2')); ?>
				</div>
				<?php echo $form->error($model,'invite_difference'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'invite_order'); ?>
			<div class="desc">
				<?php 
				if($model->isNewRecord && !$model->getErrors())
					$model->invite_diff_type = 0;
				echo $form->dropDownList($model, 'invite_order', array(
					'asc' => Yii::t('phrase', 'Ascending'),
					'desc' => Yii::t('phrase', 'Descending'),
				)); ?>
				<?php echo $form->error($model,'invite_order'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
			</div>
		</div>

	</fieldset>
<?php $this->endWidget(); ?>


