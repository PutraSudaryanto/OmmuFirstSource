<?php
/**
 * Ommu Templates (ommu-template)
 * @var $this TemplateController
 * @var $model OmmuTemplate
 * @var $form CActiveForm
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('template_key'); ?><br/>
			<?php echo $form->textField($model,'template_key'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('plugin_id'); ?><br/>
			<?php echo $form->textField($model,'plugin_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('template'); ?><br/>
			<?php echo $form->textArea($model,'template'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('variable'); ?><br/>
			<?php echo $form->textArea($model,'variable'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php echo $form->textField($model,'creation_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_id'); ?><br/>
			<?php echo $form->textField($model,'creation_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_date'); ?><br/>
			<?php echo $form->textField($model,'modified_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_id'); ?><br/>
			<?php echo $form->textField($model,'modified_id'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
