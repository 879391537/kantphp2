<?php

/**
 * @package KantPHP
 * @author  Zhenqiang Zhang <565364226@qq.com>
 * @copyright (c) 2011 KantPHP Studio, All rights reserved.
 * @license http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 */

namespace Kant\Cache;

/**
 * Cache factory
 * 
 * @final
 * @version 1.1
 * @since version1.1
 */
class Cache {

    /**
     *
     * Static instance of factory mode
     *
     */
    private static $_cache;
    
    public static function register($config = "") {
        if (self::$_cache == '') {
            self::$_cache = (new self())->driver($config);
        }
        return self::$_cache;
    }

    /**
     *
     * Load cache driver
     *
     * @param cache_name string
     * @return object on success
     */
    public function driver($options) {
        if (!empty($options['timeout'])) {
            $options['timeout'] = $options['timeout'] ?: 1;
        }
        $type = 'Kant\\Cache\\Driver\\' . ucfirst($options['type']);
        $object = new $type($options);
        return $object;
    }

    /**
     * Builds a normalized cache key from a given key.
     *
     * If the given key is a string containing alphanumeric characters only and no more than 32 characters,
     * then the key will be returned back prefixed with [[keyPrefix]]. Otherwise, a normalized key
     * is generated by serializing the given key, applying MD5 hashing, and prefixing with [[keyPrefix]].
     *
     * @param mixed $key the key to be normalized
     * @return string the generated cache key
     */
    public function buildKey($key) {
        if (is_string($key)) {
            $key = ctype_alnum($key) && mb_strlen($key, '8bit') <= 32 ? $key : md5($key);
        } else {
            $key = md5(json_encode($key));
        }
        return $key;
    }

    public static function expire($expire) {
        self::$_cache->setExpire($expire);
    }

    /**
     * Dynamically pass methods to the default connection.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters) {
        return call_user_func_array([self::$_cache, $method], $parameters);
    }

}

?>