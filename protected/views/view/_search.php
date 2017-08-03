<?php
/**
 * Ommu Page Views (ommu-page-views)
 * @var $this ViewController
 * @var $model OmmuPageViews
 * @var $form CActiveForm
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

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('view_id'); ?><br/>
			<?php echo $form->textField($model,'view_id'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('page_id'); ?><br/>
			<?php echo $form->textField($model,'page_id'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('views'); ?><br/>
			<?php echo $form->textField($model,'views'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('view_date'); ?><br/>
			<?php echo $form->textField($model,'view_date'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('view_ip'); ?><br/>
			<?php echo $form->textField($model,'view_ip'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('deleted_date'); ?><br/>
			<?php echo $form->textField($model,'deleted_date'); ?><br/>
					</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
