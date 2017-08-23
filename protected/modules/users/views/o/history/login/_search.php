<?php
/**
 * User History Logins (user-history-login)
 * @var $this LoginController
 * @var $model UserHistoryLogin
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2015 Ommu Platform (opensource.ommu.co)
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
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('lastlogin_date'); ?><br/>
			<?php echo $form->textField($model,'lastlogin_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('lastlogin_ip'); ?><br/>
			<?php echo $form->textField($model,'lastlogin_ip'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('lastlogin_from'); ?><br/>
			<?php echo $form->textField($model,'lastlogin_from'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>
