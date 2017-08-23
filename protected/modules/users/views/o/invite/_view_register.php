<?php
/**
 * User Invites (user-invites)
 * @var $this InviteController
 * @var $model UserInvites
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 5 August 2017, 17:43 WIB
 * @link https://github.com/ommu/mod-users
 * @contact (+62)856-299-4114
 *
 */

	$register = $model->newsletter->view->register == 1 ? Yii::t('phrase', 'Yes') : Yii::t('phrase', 'No');
	$register_date = !in_array($model->newsletter->view->register_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->newsletter->view->register_date, true) : '-';
	$register_name = $model->newsletter->view->user->displayname ? $model->newsletter->view->user->displayname : '-';
	$level_name = $model->newsletter->view->user_id ? Phrase::trans($model->newsletter->view->user->level->name) : '-';
?>

<ul>
	<li><?php echo Yii::t('phrase', 'Register: $register', array('$register'=>$register));?></li>
	<li><?php echo Yii::t('phrase', 'Date: $register_date', array('$register_date'=>$register_date));?></li>
	<li><?php echo Yii::t('phrase', 'Name: $register_name', array('$register_name'=>$register_name));?></li>
	<li><?php echo Yii::t('phrase', 'Level: $level_name', array('$level_name'=>$level_name));?></li>
<ul>