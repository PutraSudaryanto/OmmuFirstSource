<?php
/**
 * Ommu Zone Cities (ommu-zone-city)
 * @var $this ZonecityController
 * @var $model OmmuZoneCity
 * @var $dataProvider CActiveDataProvider
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2015 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Zone Cities',
	);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'pager' => array(
		'header' => '',
	), 
	'summaryText' => '',
	'itemsCssClass' => 'items clearfix',
	'pagerCssClass'=>'pager clearfix',
)); ?>
