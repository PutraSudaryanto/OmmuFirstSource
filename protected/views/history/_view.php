<?php
/**
 * Ommu Page View Histories (ommu-page-view-history)
 * @var $this HistoryController
 * @var $data OmmuPageViewHistory
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_id')); ?>:</b>
	<?php echo CHtml::encode($data->view_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_date')); ?>:</b>
	<?php echo CHtml::encode(Utility::dateFormat($data->view_date, true)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_ip')); ?>:</b>
	<?php echo CHtml::encode($data->view_ip); ?>
	<br />


</div>