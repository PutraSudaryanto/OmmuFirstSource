<?php
/**
 * Ommu Author Contact Categories (ommu-author-contact-category)
 * @var $this ContactCategoryController
 * @var $model OmmuAuthorContactCategory
 * @var $dataProvider CActiveDataProvider
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 1 June 2017, 05:41 WIB
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Author Contact Categories',
	);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/contact_category/_view',
	'pager' => array(
		'header' => '',
	), 
	'summaryText' => '',
	'itemsCssClass' => 'items clearfix',
	'pagerCssClass'=>'pager clearfix',
)); ?>
