<?php
/**
 * Support Feedback Views (support-feedback-view)
 * @var $this ViewsController
 * @var $model SupportFeedbackView
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 11 May 2017, 23:13 WIB
 * @link https://github.com/ommu/mod-support
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
			<?php echo $model->getAttributeLabel('view_id'); ?><br/>
			<?php echo $form->textField($model,'view_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('feedback_id'); ?><br/>
			<?php echo $form->textField($model,'feedback_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('views'); ?><br/>
			<?php echo $form->textField($model,'views'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('view_date'); ?><br/>
			<?php echo $form->textField($model,'view_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('view_ip'); ?><br/>
			<?php echo $form->textField($model,'view_ip'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_date'); ?><br/>
			<?php echo $form->textField($model,'modified_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_id'); ?><br/>
			<?php echo $form->textField($model,'modified_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('updated_date'); ?><br/>
			<?php echo $form->textField($model,'updated_date'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
