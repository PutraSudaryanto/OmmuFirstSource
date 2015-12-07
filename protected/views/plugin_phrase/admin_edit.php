<?php
/**
 * Ommu Plugin Phrase (ommu-plugin-phrase)
 * @var $this PluginphraseController
 * @var $model OmmuPluginPhrase
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Plugin Phrases'=>array('manage'),
		$model->phrase_id=>array('view','id'=>$model->phrase_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('/plugin_phrase/_form', array(
	'model'=>$model,
	'language'=>$language,
)); ?>
