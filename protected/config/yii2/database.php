<?php
/**
 * Database information
 *
 * @copyright Copyright (c) 2017 ECC UGM (ecc.ft.ugm.ac.id)
 * @link http://ecc.ft.ugm.ac.id
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @created date 8 September 2017, 05:16 WIB
 * @contact (+62)856-299-4114
 *
 */
return [
	'components' => [
		// uncomment the following to use a MySQL database
		'db' => [
			'class' => 'yii\\db\\Connection',
			'dsn' => 'mysql:host=localhost;port=3306;dbname=db.name',
			'username' => 'db.username',
			'password' => 'db.password',
			'charset' => 'utf8',
		],
	],
]; ?>