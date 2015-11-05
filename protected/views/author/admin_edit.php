<?php
/**
 * Ommu Authors (ommu-authors)
 * @var $this AuthorController * @var $model OmmuAuthors *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Authors'=>array('manage'),
		$model->name=>array('view','id'=>$model->author_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
