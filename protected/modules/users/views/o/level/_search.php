<?php
/**
 * User Levels (user-level)
 * @var $this LevelController
 * @var $model UserLevel
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/mod-users
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
			<?php echo $model->getAttributeLabel('level_id'); ?><br/>
			<?php echo $form->textField($model,'level_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('name'); ?><br/>
			<?php echo $form->textField($model,'name'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('desc'); ?><br/>
			<?php echo $form->textField($model,'desc'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('default'); ?><br/>
			<?php echo $form->textField($model,'default'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('signup'); ?><br/>
			<?php echo $form->textField($model,'signup'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('message_allow'); ?><br/>
			<?php echo $form->textField($model,'message_allow'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('message_limit'); ?><br/>
			<?php echo $form->textField($model,'message_limit'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_block'); ?><br/>
			<?php echo $form->textField($model,'profile_block'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_search'); ?><br/>
			<?php echo $form->textField($model,'profile_search'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_privacy'); ?><br/>
			<?php echo $form->textField($model,'profile_privacy'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_comments'); ?><br/>
			<?php echo $form->textField($model,'profile_comments'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_style'); ?><br/>
			<?php echo $form->textField($model,'profile_style'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_style_sample'); ?><br/>
			<?php echo $form->textField($model,'profile_style_sample'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_status'); ?><br/>
			<?php echo $form->textField($model,'profile_status'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_invisible'); ?><br/>
			<?php echo $form->textField($model,'profile_invisible'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_views'); ?><br/>
			<?php echo $form->textField($model,'profile_views'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_change'); ?><br/>
			<?php echo $form->textField($model,'profile_change'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('profile_delete'); ?><br/>
			<?php echo $form->textField($model,'profile_delete'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('photo_allow'); ?><br/>
			<?php echo $form->textField($model,'photo_allow'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('photo_size'); ?><br/>
			<?php echo $form->textField($model,'photo_size'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('photo_exts'); ?><br/>
			<?php echo $form->textField($model,'photo_exts'); ?>
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
	<div class="clear"></div>
<?php $this->endWidget(); ?>
