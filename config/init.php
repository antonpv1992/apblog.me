<?php

/** set of global initializing constants */
define('APP', str_replace('\\', '/', dirname(__DIR__)) . '/app');
define('CORE', str_replace('\\', '/', dirname(__DIR__)) . '/tools/core');
define('ROOT', str_replace('\\', '/', dirname(__DIR__)));
const CONF = ROOT . '/config';
const LIBS = ROOT . '/tools/libs/';
const LAYOUT = 'default';
const COLORS = [
    1 => 'red',
    2 => 'green',
    3 => 'yellow',
    4 => 'blue',
    5 => 'brown',
    6 => 'orange',
    7 => 'dark-blue',
    8 => 'light-green',
    9 => 'pink',
    0 => 'purple'];

/** class autoloading */
spl_autoload_register(function($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});
