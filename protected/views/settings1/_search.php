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

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_url'); ?><br/>
			<?php echo $form->textField($model,'site_url',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_title'); ?><br/>
			<?php echo $form->textField($model,'site_title',array('size'=>60,'maxlength'=>256)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_keywords'); ?><br/>
			<?php echo $form->textField($model,'site_keywords',array('size'=>60,'maxlength'=>256)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_description'); ?><br/>
			<?php echo $form->textField($model,'site_description',array('size'=>60,'maxlength'=>256)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_creation'); ?><br/>
			<?php //echo $form->textField($model,'site_creation');
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
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_dateformat'); ?><br/>
			<?php echo $form->textField($model,'site_dateformat',array('size'=>8,'maxlength'=>8)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_timeformat'); ?><br/>
			<?php echo $form->textField($model,'site_timeformat',array('size'=>8,'maxlength'=>8)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('construction_date'); ?><br/>
			<?php //echo $form->textField($model,'construction_date');
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
		</li>

		<li>
			<?php echo $model->getAttributeLabel('construction_text'); ?><br/>
			<?php echo $form->textField($model,'construction_text'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('event_startdate'); ?><br/>
			<?php //echo $form->textField($model,'event_startdate');
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
		</li>

		<li>
			<?php echo $model->getAttributeLabel('event_finishdate'); ?><br/>
			<?php //echo $form->textField($model,'event_finishdate');
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
		</li>

		<li>
			<?php echo $model->getAttributeLabel('event_tag'); ?><br/>
			<?php echo $form->textField($model,'event_tag'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_numgiven'); ?><br/>
			<?php echo $form->textField($model,'signup_numgiven'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('general_include'); ?><br/>
			<?php echo $form->textField($model,'general_include'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('general_commenthtml'); ?><br/>
			<?php echo $form->textField($model,'general_commenthtml',array('size'=>60,'maxlength'=>256)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('banned_ips'); ?><br/>
			<?php echo $form->textField($model,'banned_ips'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('banned_emails'); ?><br/>
			<?php echo $form->textField($model,'banned_emails'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('banned_usernames'); ?><br/>
			<?php echo $form->textField($model,'banned_usernames'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('banned_words'); ?><br/>
			<?php echo $form->textField($model,'banned_words'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('spam_failedcount'); ?><br/>
			<?php echo $form->textField($model,'spam_failedcount'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('analytic_id'); ?><br/>
			<?php echo $form->textField($model,'analytic_id',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('analytic_profile_id'); ?><br/>
			<?php echo $form->textField($model,'analytic_profile_id',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('license_email'); ?><br/>
			<?php echo $form->textField($model,'license_email',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('license_key'); ?><br/>
			<?php echo $form->textField($model,'license_key',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('ommu_version'); ?><br/>
			<?php echo $form->textField($model,'ommu_version',array('size'=>8,'maxlength'=>8)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_date'); ?><br/>
			<?php //echo $form->textField($model,'modified_date');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'modified_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_id'); ?><br/>
			<?php echo $form->textField($model,'modified_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('online'); ?><br/>
			<?php echo $form->checkBox($model,'online'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_oauth'); ?><br/>
			<?php echo $form->checkBox($model,'site_oauth'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_type'); ?><br/>
			<?php echo $form->checkBox($model,'site_type'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_username'); ?><br/>
			<?php echo $form->checkBox($model,'signup_username'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_approve'); ?><br/>
			<?php echo $form->checkBox($model,'signup_approve'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_verifyemail'); ?><br/>
			<?php echo $form->checkBox($model,'signup_verifyemail'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_photo'); ?><br/>
			<?php echo $form->checkBox($model,'signup_photo'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_welcome'); ?><br/>
			<?php echo $form->checkBox($model,'signup_welcome'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_random'); ?><br/>
			<?php echo $form->checkBox($model,'signup_random'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_terms'); ?><br/>
			<?php echo $form->checkBox($model,'signup_terms'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_invitepage'); ?><br/>
			<?php echo $form->checkBox($model,'signup_invitepage'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_inviteonly'); ?><br/>
			<?php echo $form->checkBox($model,'signup_inviteonly'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_checkemail'); ?><br/>
			<?php echo $form->checkBox($model,'signup_checkemail'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup_adminemail'); ?><br/>
			<?php echo $form->checkBox($model,'signup_adminemail'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('general_profile'); ?><br/>
			<?php echo $form->checkBox($model,'general_profile'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('general_invite'); ?><br/>
			<?php echo $form->checkBox($model,'general_invite'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('general_search'); ?><br/>
			<?php echo $form->checkBox($model,'general_search'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('general_portal'); ?><br/>
			<?php echo $form->checkBox($model,'general_portal'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('lang_allow'); ?><br/>
			<?php echo $form->checkBox($model,'lang_allow'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('lang_autodetect'); ?><br/>
			<?php echo $form->checkBox($model,'lang_autodetect'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('lang_anonymous'); ?><br/>
			<?php echo $form->checkBox($model,'lang_anonymous'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('spam_comment'); ?><br/>
			<?php echo $form->checkBox($model,'spam_comment'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('spam_contact'); ?><br/>
			<?php echo $form->checkBox($model,'spam_contact'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('spam_invite'); ?><br/>
			<?php echo $form->checkBox($model,'spam_invite'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('spam_login'); ?><br/>
			<?php echo $form->checkBox($model,'spam_login'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('spam_signup'); ?><br/>
			<?php echo $form->checkBox($model,'spam_signup'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('analytic'); ?><br/>
			<?php echo $form->checkBox($model,'analytic'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
