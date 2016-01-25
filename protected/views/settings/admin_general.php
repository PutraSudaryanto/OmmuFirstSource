<?php
/**
 * Ommu Settings (ommu-settings)
 * @var $this SettingsController
 * @var $model OmmuSettings
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Settings'=>array('manage'),
		'Manage',
	);
	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('#OmmuSettings_online input[name="OmmuSettings[online]"]').live('change', function() {
		var id = $(this).val();
		if(id == '0') {
			$('div#construction').slideDown();
		} else {
			$('div#construction').slideUp();
		}
	});
	$('#OmmuSettings_event input[name="OmmuSettings[event]"]').live('change', function() {
		var id = $(this).val();
		if(id == '0') {
			$('div#events').slideUp();
		} else {
			$('div#events').slideDown();
		}
	});
EOP;
	$cs->registerScript('smtp', $js, CClientScript::POS_END);
?>

<div class="form" name="post-on">

	<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
		'id'=>'ommu-settings-form',
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
			<?php echo $form->labelEx($model,'online'); ?>
			<div class="desc">
				<span class="small-px"><?php echo Phrase::trans(102,0);?></span>
				<?php echo $form->radioButtonList($model, 'online', array(
					1 => Phrase::trans(103,0),
					0 => Phrase::trans(104,0),
				)); ?>
				<?php echo $form->error($model,'online'); ?>
			</div>
		</div>

		<div id="construction" <?php echo $model->online != '0' ? 'class="hide"' : ''; ?>>
			<div class="clearfix">
				<label><?php echo $model->getAttributeLabel('construction_date');?> <span class="required">*</span></label>
				<div class="desc">
					<?php 
					$model->construction_date = date('d-m-Y', strtotime($model->construction_date));
					//echo $form->textField($model,'construction_date',array('maxlength'=>10, 'class'=>'span-3'));
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model'=>$model, 
						'attribute'=>'construction_date',
						'options'=>array(
							'dateFormat' => 'dd-mm-yy',
						),
						'htmlOptions'=>array(
							'class' => 'span-4',
						 ),
					));	?>
					<?php echo $form->error($model,'construction_date'); ?>
				</div>
			</div>

			<div class="clearfix">
				<label><?php echo $model->getAttributeLabel('construction_text')?> <span class="required">*</span></label>
				<div class="desc">
					<?php echo $form->textArea($model,'construction_text',array('rows'=>6, 'cols'=>50, 'class'=>'span-9 small')); ?>
					<?php echo $form->error($model,'construction_text'); ?>
				</div>
			</div>

		</div>

		<?php 
		$model->event = 0;
		if($model->isNewRecord || (!$model->isNewRecord && !in_array(date('Y-m-d', strtotime($model->event_startdate)), array('0000-00-00','1970-01-01')) && !in_array(date('Y-m-d', strtotime($model->event_finishdate)), array('0000-00-00','1970-01-01'))))
			$model->event = 1;
		?>
		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('event')?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->radioButtonList($model,'event', array(
					1 => 'Enable',
					0 => 'Disable',
				)); ?>
				<?php echo $form->error($model,'event'); ?>
			</div>
		</div>
		
		<div id="events" <?php echo $model->event == '0' ? 'class="hide"' : ''; ?>>
			<div class="clearfix">
				<label><?php echo $model->getAttributeLabel('event_startdate');?> <span class="required">*</span></label>
				<div class="desc">
					<?php 
					$model->event_startdate = date('d-m-Y', strtotime($model->event_startdate));
					//echo $form->textField($model,'event_startdate',array('maxlength'=>10, 'class'=>'span-3'));
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model'=>$model, 
						'attribute'=>'event_startdate',
						'options'=>array(
							'dateFormat' => 'dd-mm-yy',
						),
						'htmlOptions'=>array(
							'class' => 'span-4',
						 ),
					));	?>
					<?php echo $form->error($model,'event_startdate'); ?>
				</div>
			</div>
			
			<div class="clearfix">
				<label><?php echo $model->getAttributeLabel('event_finishdate');?> <span class="required">*</span></label>
				<div class="desc">
					<?php 
					$model->event_finishdate = date('d-m-Y', strtotime($model->event_finishdate));
					//echo $form->textField($model,'event_finishdate',array('maxlength'=>10, 'class'=>'span-3'));
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model'=>$model, 
						'attribute'=>'event_finishdate',
						'options'=>array(
							'dateFormat' => 'dd-mm-yy',
						),
						'htmlOptions'=>array(
							'class' => 'span-4',
						 ),
					));	?>
					<?php echo $form->error($model,'event_finishdate'); ?>
				</div>
			</div>

			<div class="clearfix">
				<label><?php echo $model->getAttributeLabel('event_tag')?> <span class="required">*</span></label>
				<div class="desc">
					<?php echo $form->textField($model,'event_tag',array('class'=>'span-9')); ?>
					<?php echo $form->error($model,'event_tag'); ?>
				</div>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('site_title');?> <span class="required">*</span><br/>
				<span><?php echo Phrase::trans(106,0);?></span>
			</label>
			<div class="desc">
				<?php echo $form->textField($model,'site_title',array('maxlength'=>256, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'site_title'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('site_url')?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textField($model,'site_url',array('maxlength'=>32, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'site_url'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('site_description');?> <span class="required">*</span><br/>
				<span><?php echo Phrase::trans(109,0);?></span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'site_description',array('rows'=>6, 'cols'=>50, 'class'=>'span-9', 'maxlength'=>256)); ?>
				<?php echo $form->error($model,'site_description'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('site_keywords');?> <span class="required">*</span><br/>
				<span><?php echo Phrase::trans(111,0);?></span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'site_keywords',array('rows'=>6, 'cols'=>50, 'class'=>'span-9', 'maxlength'=>256)); ?>
				<?php echo $form->error($model,'site_keywords'); ?>
			</div>
		</div>

		<?php if(OmmuSettings::getInfo('site_type') == 1) {?>
		<div class="clearfix">
			<label>
				<?php echo Phrase::trans(112,0);?>
				<span><?php echo Phrase::trans(113,0);?></span>
			</label>
			<div class="desc">
				<p><?php echo $model->getAttributeLabel('general_profile');?></p>
				<?php echo $form->radioButtonList($model, 'general_profile', array(
					1 => Phrase::trans(115,0),
					0 => Phrase::trans(116,0),
				)); ?>
				<?php echo $form->error($model,'general_profile'); ?>

				<p><?php echo $model->getAttributeLabel('general_invite');?></p>
				<?php echo $form->radioButtonList($model, 'general_invite', array(
					1 => Phrase::trans(118,0),
					0 => Phrase::trans(119,0),
				)); ?>
				<?php echo $form->error($model,'general_invite'); ?>

				<p><?php echo $model->getAttributeLabel('general_search');?></p>
				<?php echo $form->radioButtonList($model, 'general_search', array(
					1 => Phrase::trans(121,0),
					0 => Phrase::trans(122,0),
				)); ?>
				<?php echo $form->error($model,'general_search'); ?>

				<p><?php echo $model->getAttributeLabel('general_portal');?></p>
				<?php echo $form->radioButtonList($model, 'general_portal', array(
					1 => Phrase::trans(124,0),
					0 => Phrase::trans(125,0),
				)); ?>
				<?php echo $form->error($model,'general_portal'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo Phrase::trans(128,0);?></label>
			<div class="desc">
				<span class="small-px"><?php echo Phrase::trans(129,0);?></span>
				<?php echo $form->radioButtonList($model, 'signup_username', array(
					1 => Phrase::trans(130,0),
					0 => Phrase::trans(131,0),
				)); ?>
				<?php echo $form->error($model,'signup_username'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
		<?php }?>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('general_include');?>
				<span><?php echo Phrase::trans(127,0);?></span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'general_include',array('rows'=>6, 'cols'=>50, 'class'=>'span-9')); ?>
				<?php echo $form->error($model,'general_include'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Phrase::trans(1,0) : Phrase::trans(2,0), array('onclick' => 'setEnableSave()')); ?>
			</div>
		</div>

	</fieldset>
	<?php $this->endWidget(); ?>

</div>