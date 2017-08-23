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

	$register = $model->view->register == 1 ? Yii::t('phrase', 'Yes') : Yii::t('phrase', 'No');
	$register_date = !in_array($model->view->register_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->view->register_date, true) : '-';
	$register_name = $model->view->user->displayname ? $model->view->user->displayname : '-';
	$level_name = $model->view->user_id ? Phrase::trans($model->view->user->level->name) : '-';
?>

<ul>
	<li><?php echo Yii::t('phrase', 'Register: $register', array('$register'=>$register));?></li>
	<li><?php echo Yii::t('phrase', 'Date: $register_date', array('$register_date'=>$register_date));?></li>
	<li><?php echo Yii::t('phrase', 'Name: $register_name', array('$register_name'=>$register_name));?></li>
	<li><?php echo Yii::t('phrase', 'Level: $level_name', array('$level_name'=>$level_name));?></li>
<ul>