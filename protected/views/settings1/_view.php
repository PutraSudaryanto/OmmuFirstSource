<?php
/**
 * Ommu Settings (ommu-settings)
 * @var $this Settings1Controller
 * @var $data OmmuSettings
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

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('online')); ?>:</b>
	<?php echo CHtml::encode($data->online); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_oauth')); ?>:</b>
	<?php echo CHtml::encode($data->site_oauth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_type')); ?>:</b>
	<?php echo CHtml::encode($data->site_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_url')); ?>:</b>
	<?php echo CHtml::encode($data->site_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_title')); ?>:</b>
	<?php echo CHtml::encode($data->site_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->site_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_description')); ?>:</b>
	<?php echo CHtml::encode($data->site_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_creation')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->site_creation, true)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_dateformat')); ?>:</b>
	<?php echo CHtml::encode($data->site_dateformat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_timeformat')); ?>:</b>
	<?php echo CHtml::encode($data->site_timeformat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('construction_date')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->construction_date)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('construction_text')); ?>:</b>
	<?php echo CHtml::encode($data->construction_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_startdate')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->event_startdate)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_finishdate')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->event_finishdate)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_tag')); ?>:</b>
	<?php echo CHtml::encode($data->event_tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_username')); ?>:</b>
	<?php echo CHtml::encode($data->signup_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_approve')); ?>:</b>
	<?php echo CHtml::encode($data->signup_approve); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_verifyemail')); ?>:</b>
	<?php echo CHtml::encode($data->signup_verifyemail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_photo')); ?>:</b>
	<?php echo CHtml::encode($data->signup_photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_welcome')); ?>:</b>
	<?php echo CHtml::encode($data->signup_welcome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_random')); ?>:</b>
	<?php echo CHtml::encode($data->signup_random); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_terms')); ?>:</b>
	<?php echo CHtml::encode($data->signup_terms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_invitepage')); ?>:</b>
	<?php echo CHtml::encode($data->signup_invitepage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_inviteonly')); ?>:</b>
	<?php echo CHtml::encode($data->signup_inviteonly); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_checkemail')); ?>:</b>
	<?php echo CHtml::encode($data->signup_checkemail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_numgiven')); ?>:</b>
	<?php echo CHtml::encode($data->signup_numgiven); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_adminemail')); ?>:</b>
	<?php echo CHtml::encode($data->signup_adminemail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('general_profile')); ?>:</b>
	<?php echo CHtml::encode($data->general_profile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('general_invite')); ?>:</b>
	<?php echo CHtml::encode($data->general_invite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('general_search')); ?>:</b>
	<?php echo CHtml::encode($data->general_search); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('general_portal')); ?>:</b>
	<?php echo CHtml::encode($data->general_portal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('general_include')); ?>:</b>
	<?php echo CHtml::encode($data->general_include); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('general_commenthtml')); ?>:</b>
	<?php echo CHtml::encode($data->general_commenthtml); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_allow')); ?>:</b>
	<?php echo CHtml::encode($data->lang_allow); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_autodetect')); ?>:</b>
	<?php echo CHtml::encode($data->lang_autodetect); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_anonymous')); ?>:</b>
	<?php echo CHtml::encode($data->lang_anonymous); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banned_ips')); ?>:</b>
	<?php echo CHtml::encode($data->banned_ips); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banned_emails')); ?>:</b>
	<?php echo CHtml::encode($data->banned_emails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banned_usernames')); ?>:</b>
	<?php echo CHtml::encode($data->banned_usernames); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banned_words')); ?>:</b>
	<?php echo CHtml::encode($data->banned_words); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spam_comment')); ?>:</b>
	<?php echo CHtml::encode($data->spam_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spam_contact')); ?>:</b>
	<?php echo CHtml::encode($data->spam_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spam_invite')); ?>:</b>
	<?php echo CHtml::encode($data->spam_invite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spam_login')); ?>:</b>
	<?php echo CHtml::encode($data->spam_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spam_failedcount')); ?>:</b>
	<?php echo CHtml::encode($data->spam_failedcount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spam_signup')); ?>:</b>
	<?php echo CHtml::encode($data->spam_signup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('analytic')); ?>:</b>
	<?php echo CHtml::encode($data->analytic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('analytic_id')); ?>:</b>
	<?php echo CHtml::encode($data->analytic_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('analytic_profile_id')); ?>:</b>
	<?php echo CHtml::encode($data->analytic_profile_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('license_email')); ?>:</b>
	<?php echo CHtml::encode($data->license_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('license_key')); ?>:</b>
	<?php echo CHtml::encode($data->license_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ommu_version')); ?>:</b>
	<?php echo CHtml::encode($data->ommu_version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->modified_date, true)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified->displayname); ?>
	<br />


</div>