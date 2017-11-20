<?php
/**
 * Ommu Menus (ommu-menu)
 * @var $this MenuController
 * @var $model OmmuMenu
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 24 March 2016, 10:20 WIB
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */
?>

<?php 
if(!empty($sitetype_access)) {
	$count = count($sitetype_access);
	$i=0;
	foreach($sitetype_access as $val) {
		$i++;
		if($count != $i) {?>
			<?php echo $val;?>, 
		<?php } else {?>
			<?php echo $val;?>
	<?php }
	}
} else 
	echo '-';?>