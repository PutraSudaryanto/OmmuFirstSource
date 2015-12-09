<?php
/**
 * Ommu Zone Countries (ommu-zone-country)
 * @var $this ZonecountryController
 * @var $model OmmuZoneCountry
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2015 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Zone Countries'=>array('manage'),
		$model->country_id=>array('view','id'=>$model->country_id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/zone_country/_form', array('model'=>$model)); ?>
</div>
