<?php
/**
 * Merge file production, setting, database  and modules
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (www.ommu.co)
 * @link https://github.com/ommu/ommu
 *
 */
return CMap::mergeArray(
	require(dirname(__FILE__).'/production.php'),
	require(dirname(__FILE__).'/setting.php'),
	require(dirname(__FILE__).'/database.php'),
	require(dirname(__FILE__).'/modules.php')
);
?>