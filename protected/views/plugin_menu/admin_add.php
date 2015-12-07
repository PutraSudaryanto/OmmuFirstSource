<?php
/**
 * Ommu Plugin Menu (ommu-plugin-menu)
 * @var $this PluginmenuController
 * @var $model OmmuPluginMenu
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Plugin Menus'=>array('manage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('/plugin_menu/_form', array('model'=>$model)); ?>
