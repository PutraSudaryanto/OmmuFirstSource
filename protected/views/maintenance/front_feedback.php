<?php
/**
 * Support Feedbacks (support-feedbacks)
 * @var $this MaintenanceController
 * @var $model SupportFeedbacks
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (www.ommu.co)
 * @link https://github.com/PutraSudaryanto/OmmuFirstSource
 *
 */
 
	$this->breadcrumbs=array(
		'Support Mails'=>array('manage'),
		'Create',
	);
?>

<?php if(!Yii::app()->getRequest()->getParam('email')) {?>
	<div class="boxed" name="post-on">
		<?php $form=$this->beginWidget('application.libraries.yii-traits.system.OActiveForm', array(
			'id'=>'support-contacts-form',
			'enableAjaxValidation'=>true,
			'htmlOptions' => array(
				'class' => 'form',
				'enctype' => 'multipart/form-data',
			),
		)); ?>
			<fieldset>
				<?php if(!Yii::app()->user->isGuest && $user != null) {
					$model->user_id = $user->user_id;
					$model->email = $user->email;
					$model->displayname = $user->displayname;
					echo $form->hiddenField($model,'email');
					echo $form->hiddenField($model,'displayname');
				} else {
					$model->user_id = 0;
				}
				echo $form->hiddenField($model,'user_id');
				?>
				
				<?php if(Yii::app()->user->isGuest) {?>
					<div class="clearfix">
						<?php echo $form->textField($model,'displayname', array('maxlength'=>64, 'placeholder'=>$model->getAttributeLabel('displayname'))); ?>
						<?php echo $form->error($model,'displayname'); ?>
					</div>
					<div class="clearfix">
						<?php echo $form->textField($model,'email', array('maxlength'=>32, 'placeholder'=>$model->getAttributeLabel('email'))); ?>
						<?php echo $form->error($model,'email'); ?>
					</div>
				<?php } else {
					$image = Yii::app()->request->baseUrl.'/public/users/default.png';
					if($user->photos)
						$image = Yii::app()->request->baseUrl.'/public/users/'.$user->user_id.'/'.$user->photos;?>
					<div class="user-info clearfix">
						<img src="<?php echo Utility::getTimThumb($image, 60, 60, 1);?>" alt="<?php echo $user->photos ? $user->displayname: 'Ommu Platform';?>"/>
						<div>
							<h3><?php echo $user->displayname;?></h3>
							<?php echo $user->email;?>
						</div>
					</div>
				<?php }?>
				
				<div class="clearfix">
					<?php echo $form->textField($model,'subject', array('maxlength'=>64, 'placeholder'=>$model->getAttributeLabel('subject'))); ?>
					<?php echo $form->error($model,'subject'); ?>
				</div>

				<div class="clearfix">
					<?php echo $form->textArea($model,'message', array('rows'=>6, 'cols'=>50, 'class'=> 'small', 'placeholder'=>$model->getAttributeLabel('message'))); ?>
					<?php echo $form->error($model,'message'); ?>
				</div>

				<div class="submit clearfix">
					<?php echo CHtml::submitButton(Yii::t('phrase', 'Send Message'), array('onclick' => 'setEnableSave()')); ?>
				</div>

			</fieldset>
		<?php $this->endWidget();?>
	</div>

<?php } else {?>
	
<?php }?>