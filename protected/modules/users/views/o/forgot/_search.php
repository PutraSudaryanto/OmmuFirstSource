<?php
/**
 * User Forgots (user-forgot)
 * @var $this ForgotController
 * @var $model UserForgot
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 7 August 2017, 06:43 WIB
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
			<?php echo $model->getAttributeLabel('forgot_id'); ?><br/>
			<?php echo $form->textField($model,'forgot_id'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('code'); ?><br/>
			<?php echo $form->textField($model,'code'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('forgot_date'); ?><br/>
			<?php echo $form->textField($model,'forgot_date'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('forgot_ip'); ?><br/>
			<?php echo $form->textField($model,'forgot_ip'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('expired_date'); ?><br/>
			<?php echo $form->textField($model,'expired_date'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_date'); ?><br/>
			<?php echo $form->textField($model,'modified_date'); ?><br/>
					</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_id'); ?><br/>
			<?php echo $form->textField($model,'modified_id'); ?><br/>
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
