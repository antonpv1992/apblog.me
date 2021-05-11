<?php

/**
 *  set of global initializing constants
 */
define('APP', str_replace('\\', '/', dirname(__DIR__)) . '/app');
define('CORE', str_replace('\\', '/', dirname(__DIR__)) . '/tools/core');
define('ROOT', str_replace('\\', '/', dirname(__DIR__)));
const CONF = ROOT . '/config';
const LIBS = ROOT . '/tools/libs/';
const LAYOUT = 'default';

/**
 * class autoloading
 */
spl_autoload_register(function($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_file($file)){
        require_once $file;
    }
});