<?php
/**
 * Ommu Menus (ommu-menu)
 * @var $this MenuController
 * @var $model OmmuMenu
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 15 January 2016, 16:57 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('cat_id'); ?><br/>
			<?php echo $form->textField($model,'cat_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('dependency'); ?><br/>
			<?php echo $form->textField($model,'dependency'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('module'); ?><br/>
			<?php echo $form->textField($model,'module',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('controller'); ?><br/>
			<?php echo $form->textField($model,'controller',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('action'); ?><br/>
			<?php echo $form->textField($model,'action',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_type'); ?><br/>
			<?php echo $form->textField($model,'site_type'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('site_admin'); ?><br/>
			<?php echo $form->textField($model,'site_admin'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('orders'); ?><br/>
			<?php echo $form->textField($model,'orders'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('name'); ?><br/>
			<?php echo $form->textField($model,'name',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('class'); ?><br/>
			<?php echo $form->textField($model,'class',array('size'=>16,'maxlength'=>16)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('url'); ?><br/>
			<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('dialog'); ?><br/>
			<?php echo $form->textField($model,'dialog'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('attr'); ?><br/>
			<?php echo $form->textField($model,'attr',array('size'=>60,'maxlength'=>128)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php echo $form->textField($model,'creation_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_id'); ?><br/>
			<?php echo $form->textField($model,'creation_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_date'); ?><br/>
			<?php echo $form->textField($model,'modified_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_id'); ?><br/>
			<?php echo $form->textField($model,'modified_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
