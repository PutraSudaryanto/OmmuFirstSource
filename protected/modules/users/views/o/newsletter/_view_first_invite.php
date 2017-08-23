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

	$first_invite_date = $model->view->first_invite_date && !in_array($model->view->first_invite_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->view->first_invite_date, true) : '-';
	$first_invite_user = $model->view->first_user->displayname ? $model->view->first_user->displayname : '-';
?>

<ul>
	<li><?php echo Yii::t('phrase', 'Date: $first_invite_date', array('$first_invite_date'=>$first_invite_date));?></li>
	<li><?php echo Yii::t('phrase', 'User: $first_invite_user', array('$first_invite_user'=>$first_invite_user));?></li>
<ul>