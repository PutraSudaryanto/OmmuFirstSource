<?php
/**
 * Basic parameters information
 *
 * Modules:
 *	params
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/ommu
 *
 */
return array(
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'support@ommu.co',
		'primaryLang' => 'id',
		'translateLangs' => array(
			'en' => 'en',
			'id' => 'id',
		),
		
		// timthumb replace url
		'timthumb_url_replace' => 0,
		'timthumb_url_replace_website' => 'http://ommu.co',	//default http
		// access system *from product
		'product_access_system' => 'ommu.co',

		// grid-view setting
		'grid-view' => array(
			'pageSize' => 50,
		),
	
		// debug parameter
		'debug' => array(
			'send_email' => array(
				'status' => true,	// boolean
				'content' => 'send_email',	// file_put_contents, send_email
				'email'	=> 'putra.sudaryanto@gmail.com',
			),
		),
	),
);
?>