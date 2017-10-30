<?php
/**
 * Ommu Settings (ommu-settings)
 * @var $this Settings1Controller
 * @var $model OmmuSettings
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 30 October 2017, 15:29 WIB
 * @link http://opensource.ommu.co
 * @contact (+62)856-299-4114
 *
 */
?>

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
		<?php echo $form->labelEx($model,'site_url'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_url',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'site_url'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_title'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_title',array('size'=>60,'maxlength'=>256)); ?>
			<?php echo $form->error($model,'site_title'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_keywords'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_keywords',array('size'=>60,'maxlength'=>256)); ?>
			<?php echo $form->error($model,'site_keywords'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_description'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_description',array('size'=>60,'maxlength'=>256)); ?>
			<?php echo $form->error($model,'site_description'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_creation'); ?>
		<div class="desc">
			<?php $model->site_creation = !$model->isNewRecord ? (!in_array($model->site_creation, array('0000-00-00','1970-01-01')) ? date('d-m-Y', strtotime($model->site_creation)) : '') : '';
			//echo $form->textField($model,'site_creation');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'site_creation',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
			<?php echo $form->error($model,'site_creation'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_dateformat'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_dateformat',array('size'=>8,'maxlength'=>8)); ?>
			<?php echo $form->error($model,'site_dateformat'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_timeformat'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_timeformat',array('size'=>8,'maxlength'=>8)); ?>
			<?php echo $form->error($model,'site_timeformat'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'construction_date'); ?>
		<div class="desc">
			<?php $model->construction_date = !$model->isNewRecord ? (!in_array($model->construction_date, array('0000-00-00','1970-01-01')) ? date('d-m-Y', strtotime($model->construction_date)) : '') : '';
			//echo $form->textField($model,'construction_date');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'construction_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
			<?php echo $form->error($model,'construction_date'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'construction_text'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'construction_text',array('rows'=>6, 'cols'=>50));
			$this->widget('application.vendor.yiiext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>'construction_text',
				'options'=>array(
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'table' => array('js' => array('table.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			));; ?>
			<?php echo $form->error($model,'construction_text'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'event_startdate'); ?>
		<div class="desc">
			<?php $model->event_startdate = !$model->isNewRecord ? (!in_array($model->event_startdate, array('0000-00-00','1970-01-01')) ? date('d-m-Y', strtotime($model->event_startdate)) : '') : '';
			//echo $form->textField($model,'event_startdate');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'event_startdate',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
			<?php echo $form->error($model,'event_startdate'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'event_finishdate'); ?>
		<div class="desc">
			<?php $model->event_finishdate = !$model->isNewRecord ? (!in_array($model->event_finishdate, array('0000-00-00','1970-01-01')) ? date('d-m-Y', strtotime($model->event_finishdate)) : '') : '';
			//echo $form->textField($model,'event_finishdate');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'event_finishdate',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
			<?php echo $form->error($model,'event_finishdate'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'event_tag'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'event_tag',array('rows'=>6, 'cols'=>50));
			$this->widget('application.vendor.yiiext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>'event_tag',
				'options'=>array(
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'table' => array('js' => array('table.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			));; ?>
			<?php echo $form->error($model,'event_tag'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'signup_numgiven'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'signup_numgiven'); ?>
			<?php echo $form->error($model,'signup_numgiven'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'general_include'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'general_include',array('rows'=>6, 'cols'=>50));
			$this->widget('application.vendor.yiiext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>'general_include',
				'options'=>array(
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'table' => array('js' => array('table.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			));; ?>
			<?php echo $form->error($model,'general_include'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'general_commenthtml'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'general_commenthtml',array('size'=>60,'maxlength'=>256)); ?>
			<?php echo $form->error($model,'general_commenthtml'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'banned_ips'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'banned_ips',array('rows'=>6, 'cols'=>50));
			$this->widget('application.vendor.yiiext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>'banned_ips',
				'options'=>array(
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'table' => array('js' => array('table.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			));; ?>
			<?php echo $form->error($model,'banned_ips'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'banned_emails'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'banned_emails',array('rows'=>6, 'cols'=>50));
			$this->widget('application.vendor.yiiext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>'banned_emails',
				'options'=>array(
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'table' => array('js' => array('table.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			));; ?>
			<?php echo $form->error($model,'banned_emails'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'banned_usernames'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'banned_usernames',array('rows'=>6, 'cols'=>50));
			$this->widget('application.vendor.yiiext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>'banned_usernames',
				'options'=>array(
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'table' => array('js' => array('table.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			));; ?>
			<?php echo $form->error($model,'banned_usernames'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'banned_words'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'banned_words',array('rows'=>6, 'cols'=>50));
			$this->widget('application.vendor.yiiext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>'banned_words',
				'options'=>array(
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'table' => array('js' => array('table.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			));; ?>
			<?php echo $form->error($model,'banned_words'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'spam_failedcount'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'spam_failedcount'); ?>
			<?php echo $form->error($model,'spam_failedcount'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'analytic_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'analytic_id',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'analytic_id'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'analytic_profile_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'analytic_profile_id',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'analytic_profile_id'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'license_email'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'license_email',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'license_email'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'license_key'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'license_key',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'license_key'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'ommu_version'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ommu_version',array('size'=>8,'maxlength'=>8)); ?>
			<?php echo $form->error($model,'ommu_version'); ?>
			<div class="small-px silent"><?php echo Yii::t('phrase', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae laoreet metus. Integer eros augue, viverra at lectus vel, dignissim sagittis erat. ');?></div>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'online'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'online'); ?>
			<?php echo $form->labelEx($model,'online'); ?>
			<?php echo $form->error($model,'online'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'site_oauth'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'site_oauth'); ?>
			<?php echo $form->labelEx($model,'site_oauth'); ?>
			<?php echo $form->error($model,'site_oauth'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'site_type'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'site_type'); ?>
			<?php echo $form->labelEx($model,'site_type'); ?>
			<?php echo $form->error($model,'site_type'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_username'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_username'); ?>
			<?php echo $form->labelEx($model,'signup_username'); ?>
			<?php echo $form->error($model,'signup_username'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_approve'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_approve'); ?>
			<?php echo $form->labelEx($model,'signup_approve'); ?>
			<?php echo $form->error($model,'signup_approve'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_verifyemail'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_verifyemail'); ?>
			<?php echo $form->labelEx($model,'signup_verifyemail'); ?>
			<?php echo $form->error($model,'signup_verifyemail'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_photo'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_photo'); ?>
			<?php echo $form->labelEx($model,'signup_photo'); ?>
			<?php echo $form->error($model,'signup_photo'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_welcome'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_welcome'); ?>
			<?php echo $form->labelEx($model,'signup_welcome'); ?>
			<?php echo $form->error($model,'signup_welcome'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_random'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_random'); ?>
			<?php echo $form->labelEx($model,'signup_random'); ?>
			<?php echo $form->error($model,'signup_random'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_terms'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_terms'); ?>
			<?php echo $form->labelEx($model,'signup_terms'); ?>
			<?php echo $form->error($model,'signup_terms'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_invitepage'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_invitepage'); ?>
			<?php echo $form->labelEx($model,'signup_invitepage'); ?>
			<?php echo $form->error($model,'signup_invitepage'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_inviteonly'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_inviteonly'); ?>
			<?php echo $form->labelEx($model,'signup_inviteonly'); ?>
			<?php echo $form->error($model,'signup_inviteonly'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_checkemail'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_checkemail'); ?>
			<?php echo $form->labelEx($model,'signup_checkemail'); ?>
			<?php echo $form->error($model,'signup_checkemail'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'signup_adminemail'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'signup_adminemail'); ?>
			<?php echo $form->labelEx($model,'signup_adminemail'); ?>
			<?php echo $form->error($model,'signup_adminemail'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'general_profile'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'general_profile'); ?>
			<?php echo $form->labelEx($model,'general_profile'); ?>
			<?php echo $form->error($model,'general_profile'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'general_invite'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'general_invite'); ?>
			<?php echo $form->labelEx($model,'general_invite'); ?>
			<?php echo $form->error($model,'general_invite'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'general_search'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'general_search'); ?>
			<?php echo $form->labelEx($model,'general_search'); ?>
			<?php echo $form->error($model,'general_search'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'general_portal'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'general_portal'); ?>
			<?php echo $form->labelEx($model,'general_portal'); ?>
			<?php echo $form->error($model,'general_portal'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'lang_allow'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'lang_allow'); ?>
			<?php echo $form->labelEx($model,'lang_allow'); ?>
			<?php echo $form->error($model,'lang_allow'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'lang_autodetect'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'lang_autodetect'); ?>
			<?php echo $form->labelEx($model,'lang_autodetect'); ?>
			<?php echo $form->error($model,'lang_autodetect'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'lang_anonymous'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'lang_anonymous'); ?>
			<?php echo $form->labelEx($model,'lang_anonymous'); ?>
			<?php echo $form->error($model,'lang_anonymous'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'spam_comment'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'spam_comment'); ?>
			<?php echo $form->labelEx($model,'spam_comment'); ?>
			<?php echo $form->error($model,'spam_comment'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'spam_contact'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'spam_contact'); ?>
			<?php echo $form->labelEx($model,'spam_contact'); ?>
			<?php echo $form->error($model,'spam_contact'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'spam_invite'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'spam_invite'); ?>
			<?php echo $form->labelEx($model,'spam_invite'); ?>
			<?php echo $form->error($model,'spam_invite'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'spam_login'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'spam_login'); ?>
			<?php echo $form->labelEx($model,'spam_login'); ?>
			<?php echo $form->error($model,'spam_login'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'spam_signup'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'spam_signup'); ?>
			<?php echo $form->labelEx($model,'spam_signup'); ?>
			<?php echo $form->error($model,'spam_signup'); ?>
		</div>
	</div>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'analytic'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'analytic'); ?>
			<?php echo $form->labelEx($model,'analytic'); ?>
			<?php echo $form->error($model,'analytic'); ?>
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