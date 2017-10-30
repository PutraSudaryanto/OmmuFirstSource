<?php
/**
 * Core Zone Cities (core-zone-city)
 * @var $this City1Controller
 * @var $model CoreZoneCity
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 30 October 2017, 16:31 WIB
 * @link http://opensource.ommu.co
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Core Zone Cities'=>array('manage'),
		$model->city_id=>array('view','id'=>$model->city_id),
		'Update',
	);
?>

<?php /*
<div class="form" name="post-on">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
*/?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
