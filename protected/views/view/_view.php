<?php
/**
 * Ommu Page Views (ommu-page-views)
 * @var $this ViewController
 * @var $data OmmuPageViews
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 4 August 2017, 06:11 WIB
 * @link http://opensource.ommu.co
 * @contact (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->view_id), array('view', 'id'=>$data->view_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_id')); ?>:</b>
	<?php echo CHtml::encode($data->page_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user->displayname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
	<?php echo CHtml::encode($data->views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_date')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->view_date, true)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_ip')); ?>:</b>
	<?php echo CHtml::encode($data->view_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted_date')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->deleted_date, true)); ?>
	<br />


</div>