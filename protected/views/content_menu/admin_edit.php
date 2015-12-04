<?php
/**
 * OmmuContentMenu (ommu-content-menu)
 * @var $this ContentmenuController
 * @var $model OmmuContentMenu
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Content Menus'=>array('manage'),
		$model->title=>array('view','id'=>$model->menu_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('/content_menu/_form', array('model'=>$model)); ?>