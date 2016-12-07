<?php

/**
 * @package KantPHP
 * @author  Zhenqiang Zhang <565364226@qq.com>
 * @copyright (c) 2011 - 2015 KantPHP Studio, All rights reserved.
 * @license http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 */

namespace Kant;

use Kant\KantApplication;
use Kant\Config\KantConfig;
use Kant\Route\Route;
use Kant\Cache\Cache;
use Kant\Session\Session;
use Kant\Cookie\Cookie;
use Kant\Pathinfo\Pathinfo;

class KantFactory {
    
    /**
     * Object container
     * 
     */
    public static $container = [
        'application' => '',
        'config' => '',
        'route' => '',
        'cache' => '',
        'session' => '',
        'cookie' => '',
        'pathinfo' => ''        
    ];

    /**
     * Get a application object.
     * 
     * Returns the global object, only creating it if it doesn't already exist.
     * 
     * @param string $env
     * @return object
     */
    public static function getApplication($env) {
        if (!self::$container['application']) {
            self::$container['application'] = KantApplication::getInstance($env);
        }
        return self::$container['application'];
    }

    /**
     * Get config object
     */
    public static function getConfig() {
        if (!self::$container['config']) {
            //Core configuration
            $coreConfig = include KANT_PATH . DIRECTORY_SEPARATOR . 'Config/Convention.php';
            self::$container['config'] = new KantConfig($coreConfig);
        }
        return self::$container['config'];
    }

    /**
     * Get config object
     */
    public static function getRoute() {
        if (!self::$container['route']) {
            self::$container['route'] = Route::getInstance();
        }
        return self::$container['route'];
    }

    /**
     * Get cache object
     */
    public static function getCache() {
        if (!self::$container['cache']) {
            $config = self::getConfig()->get('cache.default');
            self::$container['cache'] = Cache::getInstance($config);
        }
        return self::$container['cache'];
    }

    /**
     * Get session object
     * 
     */
    public static function getSession() {
        if (!self::$container['session']) {
            $config = self::getConfig()->get('session.default');
            self::$container['session'] = Session::getInstance($config);
        }
        return self::$container['session'];
    }
    
    /**
     * Get cookie object
     */
    public static function getCookie() {
        if (!self::$container['cookie']) {
            $config = self::getConfig()->get('cookie');
            self::$container['cookie'] = Session::getInstance($config);
        }
        return self::$container['cookie'];
    } 

    /**
     * Get Pathinfo object
     */
    public static function getPathInfo() {
        if (!self::$container['pathinfo']) {
            self::$container['pathinfo'] = Pathinfo::getInstance();
        }
        return self::$container['pathinfo'];
    }

}