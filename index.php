<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED | E_STRICT);

date_default_timezone_set('Asia/Jakarta');
ini_set('post_max_size', '8M');
ini_set('upload_max_filesize', '16M');

// generate assets directory
$assets = dirname(__FILE__).'/assets';
if(!file_exists($assets)) {
	@mkdir($assets, 0777, true);
	$assetFile = join('/', [$assets, 'index.php']);
	if(!file_exists($assetFile))
		file_put_contents($assetFile, "<?php\n");
} else
	@chmod($assets, 0777, true);

// generate cache directory
$cache = dirname(__FILE__).'/cache';
if(!file_exists($cache)) {
	@mkdir($cache, 0777, true);
	$cacheFile = join('/', [$cache, 'index.php']);
	if(!file_exists($cacheFile))
		file_put_contents($cacheFile, "<?php\n");
} else
	@chmod($cache, 0777, true);

// generate themes directory
$themes = dirname(__FILE__).'/themes';
if(!file_exists($themes))
	@mkdir($themes, 0755, true);
else
	@chmod($themes, 0755, true);

// generate modules directory in protected
$modules = dirname(__FILE__).'/protected/modules';
if(!file_exists($modules))
	@mkdir($modules, 0755, true);
else
	@chmod($modules, 0755, true);

// generate runtime directory in protected
$runtime = dirname(__FILE__).'/protected/runtime';
$search = join('/', [$runtime, 'search']);
if(!file_exists($runtime) || !file_exists($search)) {
	@mkdir($runtime, 0777, true);
	if(!file_exists($search))
		@mkdir($search, 0777, true);

	$runtimeFile = join('/', [$runtime, 'index.php']);
	if(!file_exists($runtimeFile))
		file_put_contents($runtimeFile, "<?php\n");

	$searchFile = join('/', [$search, 'index.php']);
	if(!file_exists($searchFile))
		file_put_contents($searchFile, "<?php\n");
} else {
	@chmod($runtime, 0777, true);
	@chmod($search, 0777, true);
}

// generate vendor directory in protected
$vendor = dirname(__FILE__).'/protected/vendor';
if(!file_exists($vendor)) {
	@mkdir($vendor, 0777, true);
	$vendorFile = join('/', [$vendor, 'index.php']);
	if(!file_exists($vendorFile))
		file_put_contents($vendorFile, "<?php\n");
} else
	@chmod($vendor, 0777, true);

// change the following paths if necessary
$yii		= dirname(__FILE__).'/protected/vendor/yiisoft/yii/framework/yii.php';
$config		= dirname(__FILE__).'/protected/config/common.php';

if($_SERVER["SERVER_ADDR"]=='127.0.0.1' || $_SERVER["HTTP_HOST"]=='localhost')
	$config = dirname(__FILE__).'/protected/config/common-dev.php';
	
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
$app = Yii::createWebApplication($config);

define('BASEURL', Yii::app()->baseUrl);
define('URL_FORMAT', Yii::app()->urlManager->urlFormat);
define('WEB_ROOT', Yii::getPathOfAlias('webroot'));
define('APP_ROOT', Yii::getPathOfAlias('application'));

// Define constants
$showScriptName = 1;
if(!Yii::app()->urlManager->showScriptName)
	$showScriptName = 0;

define('SHOW_SCRIPT_NAME', $showScriptName);

$app->run();