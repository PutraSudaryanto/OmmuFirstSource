<?php
/**
 * Core Zone Cities (core-zone-city)
 * @var $this City1Controller
 * @var $model CoreZoneCity
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 30 October 2017, 15:18 WIB
 * @link http://opensource.ommu.co
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
			<?php echo $model->getAttributeLabel('city_id'); ?><br/>
			<?php echo $form->textField($model,'city_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('province_id'); ?><br/>
			<?php echo $form->textField($model,'province_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('city_name'); ?><br/>
			<?php echo $form->textField($model,'city_name',array('size'=>60,'maxlength'=>64)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('mfdonline'); ?><br/>
			<?php echo $form->textField($model,'mfdonline',array('size'=>4,'maxlength'=>4)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php //echo $form->textField($model,'creation_date');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'creation_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_id'); ?><br/>
			<?php echo $form->textField($model,'creation_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_date'); ?><br/>
			<?php //echo $form->textField($model,'modified_date');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'modified_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_id'); ?><br/>
			<?php echo $form->textField($model,'modified_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('updated_date'); ?><br/>
			<?php //echo $form->textField($model,'updated_date');
			$this->widget('application.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'updated_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			));; ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->checkBox($model,'publish'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('checked'); ?><br/>
			<?php echo $form->checkBox($model,'checked'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
