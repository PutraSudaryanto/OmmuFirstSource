<?php
/**
 * Database information
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (www.ommu.co)
 * @link https://github.com/ommu/ommu
 *
 */
return array(
	'components'=>array(
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=db.name',
			//'emulatePrepare' => true,
			'username' => 'db.username',
			'password' => 'db.password',
			'charset' => 'utf8',
		),
	),
);
?>