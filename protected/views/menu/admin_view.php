<?php
/**
 * Ommu Menus (ommu-menu)
 * @var $this MenuController
 * @var $model OmmuMenu
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 24 March 2016, 10:20 WIB
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Menus'=>array('manage'),
		$model->name,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'id',
				'value'=>$model->id,
			),
			array(
				'name'=>'publish',
				'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'cat_id',
				'value'=>Phrase::trans($model->cat->name),
			),
			array(
				'name'=>'parent',
				'value'=>$model->parent != 0 ? Phrase::trans($model->parentmenu->name) : '-',
			),
			array(
				'name'=>'orders',
				'value'=>$model->orders,
			),
			array(
				'name'=>'name',
				'value'=>Phrase::trans($model->name),
			),
			array(
				'name'=>'url',
				'value'=>$model->url != '' ? $model->url : '-',
			),
			array(
				'name'=>'attr',
				'value'=>$model->attr != '' ? $model->attr : '-',
			),
			array(
				'name'=>'sitetype_access',
				'value'=>$model->sitetype_access != '' ? $this->renderPartial('_view_sitetype', array('sitetype_access'=>unserialize($model->sitetype_access)), true, false) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'sitetype_access',
				'value'=>$model->userlevel_access != '' ? $this->renderPartial('_view_userlevel', array('userlevel_access'=>unserialize($model->userlevel_access)), true, false) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'creation_date',
				'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
			),
			array(
				'name'=>'creation_id',
				'value'=>$model->creation->displayname ? $model->creation->displayname : '-',
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
				'name'=>'updated_date',
				'value'=>!in_array($model->updated_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->updated_date, true) : '-',
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
