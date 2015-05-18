<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

use Martin\Application;

define('ROOT_PATH',         __DIR__ . '/..');
define('WEB_PATH',          __DIR__ . '/../web');
define('ASSETS_PATH',       __DIR__ . '/../web/assets');
define('VENDOR_PATH',       __DIR__ . '/../vendor');
define('CONFIG_PATH',       __DIR__ . '/../application/config');
define('CONTROLLERS_PATH',  __DIR__ . '/../application/controllers');
define('LAYOUTS_PATH',      __DIR__ . '/../application/layouts');
define('VIEWS_PATH',        __DIR__ . '/../application/views');
define('DB_PATH',           __DIR__ . '/../application/db');

spl_autoload_register(function($class) {
    $inVendorPath = VENDOR_PATH . DIRECTORY_SEPARATOR . 'idzn' . DIRECTORY_SEPARATOR .
        str_ireplace('\\', '/', $class) . '.php';
    $inRootPath = ROOT_PATH . DIRECTORY_SEPARATOR . str_ireplace('\\', '/', $class) . '.php';
    if (file_exists($inVendorPath)) include_once $inVendorPath;
    if (file_exists($inRootPath)) include_once $inRootPath;
});

require VENDOR_PATH . '/autoload.php';

require CONFIG_PATH . DIRECTORY_SEPARATOR . 'environment.php';
$proConfig = require CONFIG_PATH . DIRECTORY_SEPARATOR . 'pro.config.php';
$envConfig = require CONFIG_PATH . DIRECTORY_SEPARATOR . APP_ENVIRONMENT . '.config.php';
$config = array_replace_recursive($proConfig, $envConfig);

(new Application($config))->run();

