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

	$displayname = $model->feedback->user_id ? $model->feedback->user->displayname : ($model->feedback->displayname ? $model->feedback->displayname : '-');
	$email_address = $model->feedback->user_id ? $model->feedback->user->email : ($model->feedback->email ? $model->feedback->email : '-');
	$phone_number = $model->feedback->phone ? $model->feedback->phone : '-';
?>

<ul>
	<li><?php echo Yii::t('phrase', 'Name: $displayname', array('$displayname'=>$displayname));?></li>
	<li><?php echo Yii::t('phrase', 'Email: $email_address', array('$email_address'=>$email_address));?></li>
	<li><?php echo Yii::t('phrase', 'Phone: $phone_number', array('$phone_number'=>$phone_number));?></li>
<ul>