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

	$last_invite_date = $model->view->last_invite_date && !in_array($model->view->last_invite_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->view->last_invite_date, true) : '-';
	$last_invite_user = $model->view->last_user->displayname ? $model->view->last_user->displayname : '-';
?>

<ul>
	<li><?php echo Yii::t('phrase', 'Date: $last_invite_date', array('$last_invite_date'=>$last_invite_date));?></li>
	<li><?php echo Yii::t('phrase', 'User: $last_invite_user', array('$last_invite_user'=>$last_invite_user));?></li>
<ul>