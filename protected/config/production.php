<?php
/**
 * This is the main Web application configuration. Any writable
 * CWebApplication properties can be configured here.
 *
 * uncomment the following to define a path alias
 * Yii::setPathOfAlias('local','path/to/local-folder');
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/ommu
 *
 */

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Ommu Platform',

	// Language setting
	'sourceLanguage' => '00',
	'language'       => 'id',
	'behaviors' => array('AppConfigBehavior'),

	// preloading 'log' component
	'preload'=>array('log', 'ommu'),

	// autoloading model and component classes
	'import'=>array(
		// Model
		'application.models.*',
		'application.libraries.core.models.*',

		// Components
		'application.components.*',
		'application.libraries.core.components.public.*',
		'application.libraries.core.components.system.*',

		// Module Model
		'application.vendor.ommu.report.models.*',
		'application.vendor.ommu.report.models.view.*',
		'application.vendor.ommu.support.models.*',
		'application.vendor.ommu.support.models.view.*',
		'application.vendor.ommu.users.models.*',
		'application.vendor.ommu.users.models.view.*',

		// Module Components
		'application.vendor.ommu.report.components.*',
		'application.vendor.ommu.support.components.*',
		'application.vendor.ommu.users.components.*',
	),

	// application components
	'components'=>array(
		//Ommu custom components
		'ommu' => array(
			'class' => 'application.libraries.core.ommu.Ommu',
		),
		
		//Ommu module/plugin handle
		'moduleHandle' => array(
			'class' => 'application.libraries.core.ommu.ModuleHandle'
		),

		//move core message yii to protected
		'coreMessages' => array(
			'basePath' => null,
		),

		'clientScript' => array(
			'class' => 'OClientScript',
			'coreScriptPosition' => CClientScript::POS_END,
		),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

);