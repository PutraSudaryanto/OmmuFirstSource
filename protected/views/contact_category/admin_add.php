<?php
/**
 * Ommu Author Contact Categories (ommu-author-contact-category)
 * @var $this ContactCategoryController
 * @var $model OmmuAuthorContactCategory
 * @var $form CActiveForm
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 1 June 2017, 05:41 WIB
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Author Contact Categories'=>array('manage'),
		'Create',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/contact_category/_form', array('model'=>$model)); ?>
</div>
