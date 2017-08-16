<?php
/**
 * Ommu Settings (ommu-settings)
 * @var $this SettingsController
 * @var $model OmmuSettings
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 Augustus 2017, 06:42 WIB
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Settings'=>array('manage'),
		'Manage',
	);
?>

<div class="form" name="post-on">
	<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
		'id'=>'ommu-locale-form',
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
			<?php echo $form->labelEx($model,'site_dateformat'); ?>
			<div class="desc">
				<?php 
				$dateformat = "1986-08-11 16:25:50";
				echo $form->dropDownList($model,'site_dateformat', array(
					'n/j/Y' => date('n/j/Y', strtotime($dateformat)),
					'n-j-Y' => date('n-j-Y', strtotime($dateformat)),
					'm/j/Y' => date('m/j/Y', strtotime($dateformat)),
					'm-j-Y' => date('m-j-Y', strtotime($dateformat)),		
					'Y/n/j' => date('Y/n/j', strtotime($dateformat)),
					'Y-n-j' => date('Y-n-j', strtotime($dateformat)),
					'Y/m/j' => date('Y/m/j', strtotime($dateformat)),
					'Y-m-d' => date('Y-m-d', strtotime($dateformat)),
					'j/n/Y' => date('j/n/Y', strtotime($dateformat)),
					'j-n-Y' => date('j-n-Y', strtotime($dateformat)),
					'j/m/Y' => date('j/m/Y', strtotime($dateformat)),
					'j-m-Y' => date('j-m-Y', strtotime($dateformat)),
					'Y-F-j' => date('Y-F-j', strtotime($dateformat)),
					'j-F-Y' => date('j-F-Y', strtotime($dateformat)),
					'Y-M-j' => date('Y-M-j', strtotime($dateformat)),
					'j-M-Y' => date('j-M-Y', strtotime($dateformat)),
					'F j, Y' => date('F j, Y', strtotime($dateformat)),
					'j F Y' => date('j F Y', strtotime($dateformat)),
					'M. j, Y' => date('M. j, Y', strtotime($dateformat)),
					'j M Y' => date('j M Y', strtotime($dateformat)),
					'l, F j, Y' => date('l, F j, Y', strtotime($dateformat)),
					'l j F Y' => date('l j F Y', strtotime($dateformat)),
					'D j F Y' => date('D j F Y', strtotime($dateformat)),
					'D j M Y' => date('D j M Y', strtotime($dateformat)),
				)); ?>
				<?php echo $form->error($model,'site_dateformat'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'site_timeformat'); ?>
			<div class="desc">
				<?php 
				echo $form->dropDownList($model,'site_timeformat', array(
					'g:i A' => date('g:i A', strtotime($dateformat)),
					'h:i A' => date('h:i A', strtotime($dateformat)),
					'g:i' => date('g:i', strtotime($dateformat)),
					'h:i' => date('h:i', strtotime($dateformat)),
					'H:i' => date('H:i', strtotime($dateformat)),
					'H\hi' => date('H\hi', strtotime($dateformat)),
				)); ?>
				<?php echo $form->error($model,'site_timeformat'); ?>
			</div>
		</div>

		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton(Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
			</div>
		</div>

	</fieldset>
	<?php $this->endWidget(); ?>
</div>
