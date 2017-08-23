<?php
/**
 * User Invites (user-invites)
 * @var $this InviteController
 * @var $model UserInvites
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

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('invite_id'); ?><br/>
			<?php echo $form->textField($model,'invite_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('newsletter_id'); ?><br/>
			<?php echo $form->textField($model,'newsletter_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('code'); ?><br/>
			<?php echo $form->textField($model,'code'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('invites'); ?><br/>
			<?php echo $form->textField($model,'invites'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('invite_date'); ?><br/>
			<?php echo $form->textField($model,'invite_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('invite_ip'); ?><br/>
			<?php echo $form->textField($model,'invite_ip'); ?>
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
	<div class="clear"></div>
<?php $this->endWidget(); ?>
