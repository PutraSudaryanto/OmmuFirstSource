<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED | E_STRICT);

date_default_timezone_set('Asia/Jakarta');
ini_set('post_max_size', '8M');
ini_set('upload_max_filesize', '16M');

// change the following paths if necessary
$yii    = dirname(__FILE__).'/protected/vendor/yiisoft/yii/framework/yii.php';
$config = dirname(__FILE__).'/protected/config/common.php';

if($_SERVER["SERVER_ADDR"]=='127.0.0.1' || $_SERVER["HTTP_HOST"]=='localhost') {
	$config = dirname(__FILE__).'/protected/config/common-dev.php';
	
	// generate assets directory
	if(!file_exists(dirname(__FILE__).'/assets')) {
		mkdir('assets');
		@chmod(dirname(__FILE__).'/assets', 0777);
	}
	
	// generate cache directory
	if(!file_exists(dirname(__FILE__).'/cache')) {
		mkdir('cache');
		@chmod(dirname(__FILE__).'/cache', 0777);
	}
	
	// generate themes directory
	if(!file_exists(dirname(__FILE__).'/themes')) {
		mkdir('themes');
		@chmod(dirname(__FILE__).'/themes', 0777);
	}
	
	// generate modules directory in protected
	if(!file_exists(dirname(__FILE__).'/protected/modules')) {
		mkdir(dirname(__FILE__).'/protected/modules');
		@chmod(dirname(__FILE__).'/protected/modules', 0777);
	}
	
	// generate runtime directory in protected
	if(!file_exists(dirname(__FILE__).'/protected/runtime')) {
		mkdir(dirname(__FILE__).'/protected/runtime');
		@chmod(dirname(__FILE__).'/protected/runtime', 0777);
	}
	
	// generate vendor directory in protected
	if(!file_exists(dirname(__FILE__).'/protected/vendor')) {
		mkdir(dirname(__FILE__).'/protected/vendor');
		@chmod(dirname(__FILE__).'/protected/vendor', 0777);
	}
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);

define('BASEURL', Yii::app()->baseUrl);
define('URL_FORMAT', Yii::app()->urlManager->urlFormat);
define('WEB_ROOT', Yii::getPathOfAlias('webroot'));
define('APP_ROOT', Yii::getPathOfAlias('application'));

// Define constants
$showScriptName = 1;
if(!Yii::app()->urlManager->showScriptName) {
	$showScriptName = 0;
}
define('SHOW_SCRIPT_NAME', $showScriptName);

$app->run();
