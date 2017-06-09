<?php
/**
 * Users (users)
 * @var $this MemberController
 * @var $model Users
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 25 February 2016, 15:47 WIB
 * @link https://github.com/ommu/mod-users
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Users'=>array('manage'),
		$model->user_id,
	);
?>

<div class="box">
	<?php $this->widget('application.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'user_id',
				'value'=>$model->user_id,
			),
			array(
				'name'=>'enabled',
				'value'=>$model->enabled == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'verified',
				'value'=>$model->verified == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'level_id',
				'value'=>Phrase::trans($model->level->name),
			),
			array(
				'name'=>'language_id',
				'value'=>$model->language->name,
			),
			array(
				'name'=>'locale_id',
				'value'=>$model->locale->title,
			),
			array(
				'name'=>'timezone_id',
				'value'=>$model->timezone->title.' | '.$model->timezone->timezone_name,
			),
			array(
				'name'=>'email',
				'value'=>$model->email,
			),
			array(
				'name'=>'username',
				'value'=>$model->username ? $model->username : '-',
			),
			array(
				'name'=>'first_name',
				'value'=>$model->first_name,
			),
			array(
				'name'=>'last_name',
				'value'=>$model->last_name,
			),
			array(
				'name'=>'displayname',
				'value'=>$model->displayname ? $model->displayname : '-',
			),
			/*
			array(
				'name'=>'password',
				'value'=>$model->password,
			),
			*/
			array(
				'name'=>'photos',
				'value'=>$model->photos ? CHtml::link($model->photos, $model->photos, array('target' => '_blank')) : '-',
				'type'=>'raw',
			),
			/*
			array(
				'name'=>'salt',
				'value'=>$model->salt,
			),
			*/
			array(
				'name'=>'deactivate',
				'value'=>$model->deactivate == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'search',
				'value'=>$model->search == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'invisible',
				'value'=>$model->invisible == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'privacy',
				'value'=>$model->privacy == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'comments',
				'value'=>$model->comments == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'creation_date',
				'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
			),
			array(
				'name'=>'creation_ip',
				'value'=>$model->creation_ip ? $model->creation_ip : '-',
			),
			array(
				'name'=>'modified_date',
				'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
			),
			array(
				'name'=>'modified_id',
				'value'=>$model->modified->displayname ? $model->modified->displayname : '-',
			),
			array(
				'name'=>'lastlogin_date',
				'value'=>!in_array($model->lastlogin_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->lastlogin_date, true) : '-',
			),
			array(
				'name'=>'lastlogin_ip',
				'value'=>$model->lastlogin_ip ? $model->lastlogin_ip : '-',
			),
			array(
				'name'=>'lastlogin_from',
				'value'=>$model->lastlogin_from ? $model->lastlogin_from : '-',
			),
			array(
				'name'=>'update_date',
				'value'=>!in_array($model->update_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->update_date, true) : '-',
			),
			array(
				'name'=>'update_ip',
				'value'=>$model->update_ip ? $model->update_ip : '-',
			),
		),
	)); ?>
</div>