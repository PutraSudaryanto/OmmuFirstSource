<?php
/**
 * User Invite Histories (user-invite-history)
 * @var $this InvitehistoryController
 * @var $model UserInviteHistory
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 5 August 2017, 19:31 WIB
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
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('invite_id'); ?><br/>
			<?php echo $form->textField($model,'invite_id'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('code'); ?><br/>
			<?php echo $form->textField($model,'code'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('invite_date'); ?><br/>
			<?php echo $form->textField($model,'invite_date'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('invite_ip'); ?><br/>
			<?php echo $form->textField($model,'invite_ip'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('expired_date'); ?><br/>
			<?php echo $form->textField($model,'expired_date'); ?><br/>
					</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
