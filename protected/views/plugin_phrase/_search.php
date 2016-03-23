<?php
/**
 * Ommu Plugin Phrase (ommu-plugin-phrase)
 * @var $this PluginphraseController
 * @var $model OmmuPluginPhrase
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('phrase_id'); ?><br/>
			<?php echo $form->textField($model,'phrase_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('plugin_id'); ?><br/>
			<?php echo $form->textField($model,'plugin_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('location'); ?><br/>
			<?php echo $form->textField($model,'location',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('en'); ?><br/>
			<?php echo $form->textArea($model,'en',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>
