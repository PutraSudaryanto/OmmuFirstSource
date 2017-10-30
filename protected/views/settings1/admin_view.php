<?php
/**
 * Ommu Settings (ommu-settings)
 * @var $this Settings1Controller
 * @var $model OmmuSettings
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 30 October 2017, 15:29 WIB
 * @link http://opensource.ommu.co
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Settings'=>array('manage'),
		$model->id,
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
			'name'=>'id',
			'value'=>$model->id,
		),
		array(
			'name'=>'online',
			'value'=>$model->online,
			//'value'=>$model->online ? $model->online : '-',
		),
		array(
			'name'=>'site_oauth',
			'value'=>$model->site_oauth,
			//'value'=>$model->site_oauth ? $model->site_oauth : '-',
		),
		array(
			'name'=>'site_type',
			'value'=>$model->site_type,
			//'value'=>$model->site_type ? $model->site_type : '-',
		),
		array(
			'name'=>'site_url',
			'value'=>$model->site_url,
			//'value'=>$model->site_url ? $model->site_url : '-',
		),
		array(
			'name'=>'site_title',
			'value'=>$model->site_title,
			//'value'=>$model->site_title ? $model->site_title : '-',
		),
		array(
			'name'=>'site_keywords',
			'value'=>$model->site_keywords,
			//'value'=>$model->site_keywords ? $model->site_keywords : '-',
		),
		array(
			'name'=>'site_description',
			'value'=>$model->site_description,
			//'value'=>$model->site_description ? $model->site_description : '-',
		),
		array(
			'name'=>'site_creation',
			'value'=>!in_array($model->site_creation, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->site_creation, true) : '-',
		),
		array(
			'name'=>'site_dateformat',
			'value'=>$model->site_dateformat,
			//'value'=>$model->site_dateformat ? $model->site_dateformat : '-',
		),
		array(
			'name'=>'site_timeformat',
			'value'=>$model->site_timeformat,
			//'value'=>$model->site_timeformat ? $model->site_timeformat : '-',
		),
		array(
			'name'=>'construction_date',
			'value'=>!in_array($model->construction_date, array('0000-00-00','1970-01-01')) ? Utility::dateFormat($model->construction_date) : '-',
		),
		array(
			'name'=>'construction_text',
			'value'=>$model->construction_text ? $model->construction_text : '-',
			//'value'=>$model->construction_text ? CHtml::link($model->construction_text, Yii::app()->request->baseUrl.'/public/visit/'.$model->construction_text, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'event_startdate',
			'value'=>!in_array($model->event_startdate, array('0000-00-00','1970-01-01')) ? Utility::dateFormat($model->event_startdate) : '-',
		),
		array(
			'name'=>'event_finishdate',
			'value'=>!in_array($model->event_finishdate, array('0000-00-00','1970-01-01')) ? Utility::dateFormat($model->event_finishdate) : '-',
		),
		array(
			'name'=>'event_tag',
			'value'=>$model->event_tag ? $model->event_tag : '-',
			//'value'=>$model->event_tag ? CHtml::link($model->event_tag, Yii::app()->request->baseUrl.'/public/visit/'.$model->event_tag, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'signup_username',
			'value'=>$model->signup_username,
			//'value'=>$model->signup_username ? $model->signup_username : '-',
		),
		array(
			'name'=>'signup_approve',
			'value'=>$model->signup_approve,
			//'value'=>$model->signup_approve ? $model->signup_approve : '-',
		),
		array(
			'name'=>'signup_verifyemail',
			'value'=>$model->signup_verifyemail,
			//'value'=>$model->signup_verifyemail ? $model->signup_verifyemail : '-',
		),
		array(
			'name'=>'signup_photo',
			'value'=>$model->signup_photo,
			//'value'=>$model->signup_photo ? $model->signup_photo : '-',
		),
		array(
			'name'=>'signup_welcome',
			'value'=>$model->signup_welcome,
			//'value'=>$model->signup_welcome ? $model->signup_welcome : '-',
		),
		array(
			'name'=>'signup_random',
			'value'=>$model->signup_random,
			//'value'=>$model->signup_random ? $model->signup_random : '-',
		),
		array(
			'name'=>'signup_terms',
			'value'=>$model->signup_terms,
			//'value'=>$model->signup_terms ? $model->signup_terms : '-',
		),
		array(
			'name'=>'signup_invitepage',
			'value'=>$model->signup_invitepage,
			//'value'=>$model->signup_invitepage ? $model->signup_invitepage : '-',
		),
		array(
			'name'=>'signup_inviteonly',
			'value'=>$model->signup_inviteonly,
			//'value'=>$model->signup_inviteonly ? $model->signup_inviteonly : '-',
		),
		array(
			'name'=>'signup_checkemail',
			'value'=>$model->signup_checkemail,
			//'value'=>$model->signup_checkemail ? $model->signup_checkemail : '-',
		),
		array(
			'name'=>'signup_numgiven',
			'value'=>$model->signup_numgiven,
			//'value'=>$model->signup_numgiven ? $model->signup_numgiven : '-',
		),
		array(
			'name'=>'signup_adminemail',
			'value'=>$model->signup_adminemail,
			//'value'=>$model->signup_adminemail ? $model->signup_adminemail : '-',
		),
		array(
			'name'=>'general_profile',
			'value'=>$model->general_profile,
			//'value'=>$model->general_profile ? $model->general_profile : '-',
		),
		array(
			'name'=>'general_invite',
			'value'=>$model->general_invite,
			//'value'=>$model->general_invite ? $model->general_invite : '-',
		),
		array(
			'name'=>'general_search',
			'value'=>$model->general_search,
			//'value'=>$model->general_search ? $model->general_search : '-',
		),
		array(
			'name'=>'general_portal',
			'value'=>$model->general_portal,
			//'value'=>$model->general_portal ? $model->general_portal : '-',
		),
		array(
			'name'=>'general_include',
			'value'=>$model->general_include ? $model->general_include : '-',
			//'value'=>$model->general_include ? CHtml::link($model->general_include, Yii::app()->request->baseUrl.'/public/visit/'.$model->general_include, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'general_commenthtml',
			'value'=>$model->general_commenthtml,
			//'value'=>$model->general_commenthtml ? $model->general_commenthtml : '-',
		),
		array(
			'name'=>'lang_allow',
			'value'=>$model->lang_allow,
			//'value'=>$model->lang_allow ? $model->lang_allow : '-',
		),
		array(
			'name'=>'lang_autodetect',
			'value'=>$model->lang_autodetect,
			//'value'=>$model->lang_autodetect ? $model->lang_autodetect : '-',
		),
		array(
			'name'=>'lang_anonymous',
			'value'=>$model->lang_anonymous,
			//'value'=>$model->lang_anonymous ? $model->lang_anonymous : '-',
		),
		array(
			'name'=>'banned_ips',
			'value'=>$model->banned_ips ? $model->banned_ips : '-',
			//'value'=>$model->banned_ips ? CHtml::link($model->banned_ips, Yii::app()->request->baseUrl.'/public/visit/'.$model->banned_ips, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'banned_emails',
			'value'=>$model->banned_emails ? $model->banned_emails : '-',
			//'value'=>$model->banned_emails ? CHtml::link($model->banned_emails, Yii::app()->request->baseUrl.'/public/visit/'.$model->banned_emails, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'banned_usernames',
			'value'=>$model->banned_usernames ? $model->banned_usernames : '-',
			//'value'=>$model->banned_usernames ? CHtml::link($model->banned_usernames, Yii::app()->request->baseUrl.'/public/visit/'.$model->banned_usernames, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'banned_words',
			'value'=>$model->banned_words ? $model->banned_words : '-',
			//'value'=>$model->banned_words ? CHtml::link($model->banned_words, Yii::app()->request->baseUrl.'/public/visit/'.$model->banned_words, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'spam_comment',
			'value'=>$model->spam_comment,
			//'value'=>$model->spam_comment ? $model->spam_comment : '-',
		),
		array(
			'name'=>'spam_contact',
			'value'=>$model->spam_contact,
			//'value'=>$model->spam_contact ? $model->spam_contact : '-',
		),
		array(
			'name'=>'spam_invite',
			'value'=>$model->spam_invite,
			//'value'=>$model->spam_invite ? $model->spam_invite : '-',
		),
		array(
			'name'=>'spam_login',
			'value'=>$model->spam_login,
			//'value'=>$model->spam_login ? $model->spam_login : '-',
		),
		array(
			'name'=>'spam_failedcount',
			'value'=>$model->spam_failedcount,
			//'value'=>$model->spam_failedcount ? $model->spam_failedcount : '-',
		),
		array(
			'name'=>'spam_signup',
			'value'=>$model->spam_signup,
			//'value'=>$model->spam_signup ? $model->spam_signup : '-',
		),
		array(
			'name'=>'analytic',
			'value'=>$model->analytic,
			//'value'=>$model->analytic ? $model->analytic : '-',
		),
		array(
			'name'=>'analytic_id',
			'value'=>$model->analytic_id,
			//'value'=>$model->analytic_id ? $model->analytic_id : '-',
		),
		array(
			'name'=>'analytic_profile_id',
			'value'=>$model->analytic_profile_id,
			//'value'=>$model->analytic_profile_id ? $model->analytic_profile_id : '-',
		),
		array(
			'name'=>'license_email',
			'value'=>$model->license_email,
			//'value'=>$model->license_email ? $model->license_email : '-',
		),
		array(
			'name'=>'license_key',
			'value'=>$model->license_key,
			//'value'=>$model->license_key ? $model->license_key : '-',
		),
		array(
			'name'=>'ommu_version',
			'value'=>$model->ommu_version,
			//'value'=>$model->ommu_version ? $model->ommu_version : '-',
		),
		array(
			'name'=>'modified_date',
			'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
		),
		array(
			'name'=>'modified_id',
			'value'=>$model->modified_id ? $model->modified->displayname : '-',
		),
	),
)); ?>

<div class="box">
</div>
<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>