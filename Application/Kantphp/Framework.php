<?php

/**
 * @package KantPHP
 * @author  Zhenqiang Zhang <565364226@qq.com>
 * @copyright (c) 2011 - 2015 KantPHP Studio, All rights reserved.
 * @license http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 */
define('IN_KANT', TRUE);
//KantPHP path
define('KANT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

require_once KANT_PATH . 'Function/Global.php';
require_once KANT_PATH . 'Core/KantFactory.php';
require_once KANT_PATH . 'Core/KantApplication.php';
require_once APP_PATH . 'Function/Common.php';

ini_set('magic_quotes_runtime', 0);
if (get_magic_quotes_gpc() == false) {
    $_POST = array_map('addslashess', $_POST);
    $_GET = array_map('addslashess', $_GET);
    $_COOKIE = array_map('addslashess', $_COOKIE);
}

//App path
if (!defined('APP_PATH')) {
    define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . DIRECTORY_SEPARATOR . 'Application' . DIRECTORY_SEPARATOR);
}

//Cache directory
define('CACHE_PATH', APP_PATH . 'Cache' . DIRECTORY_SEPARATOR);
//Template directory
define('TPL_PATH', APP_PATH . 'View' . DIRECTORY_SEPARATOR);
//Config directroy
define('CFG_PATH', APP_PATH . 'Config' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', APP_PATH . 'Module' . DIRECTORY_SEPARATOR);
//Libary directory
define('LIB_PATH', APP_PATH . 'Library' . DIRECTORY_SEPARATOR);
//Public Path
define('PUBLIC_PATH', dirname(APP_PATH) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
//Log path
if (!defined('LOG_PATH')) {
    define('LOG_PATH', APP_PATH . 'Logs/');
}
//Web root
if (!defined('APP_URL')) {
    define('APP_URL', substr(dirname($_SERVER['SCRIPT_NAME']), -1, 1) == '/' ? dirname($_SERVER['SCRIPT_NAME']) : dirname($_SERVER['SCRIPT_NAME']) . '/' );
}
define('PUBLIC_URL', APP_URL . 'public/');
define('IS_CGI', (0 === strpos(PHP_SAPI, 'cgi') || false !== strpos(PHP_SAPI, 'fcgi')) ? 1 : 0 );
define('IS_CLI', PHP_SAPI == 'cli' ? 1 : 0);
define('CHARSET', 'utf-8');

//header("Content-type: text/html; charset=utf-8"); 