<?php
/**
 * OmmuPhrases (ommu-phrases)
 * @var $this PhraseController
 * @var $model OmmuPhrases
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Phrases'=>array('manage'),
		$model->phrase_id=>array('view','id'=>$model->phrase_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'language'=>$language,
)); ?>