<?php
/**
 * Ommu Options (ommu-options)
 * @var $this OptionController
 * @var $data OmmuOptions
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 17 March 2017, 10:49 WIB
 * @link https://github.com/ommu/Core
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->option_id), array('view', 'id'=>$data->option_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('autoload')); ?>:</b>
	<?php echo CHtml::encode($data->autoload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_type')); ?>:</b>
	<?php echo CHtml::encode($data->option_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_name')); ?>:</b>
	<?php echo CHtml::encode($data->option_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_value')); ?>:</b>
	<?php echo CHtml::encode($data->option_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_id')); ?>:</b>
	<?php echo CHtml::encode($data->creation_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified_id); ?>
	<br />

	*/ ?>

</div>