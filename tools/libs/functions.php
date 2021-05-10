<?php
/**
 * method for debug outputting an array
 * @param $arr array to display
 */
function debug(array $arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

/**
 * method for converting names to CamelCase
 * @param string $name
 * @return string
 */
function upperCamelCase(string $name)
{
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
}

/**
 * method for converting names to camelCase
 * @param string $name
 * @return string
 */
function lowerCamelCase(string $name)
{
    return lcfirst(upperCamelCase($name));
}

/**
 * route redirecting method
 * @param bool|string $http link
 */
function redirect(bool|string $http = false)
{
    if($http){
        $redirect = $http;
    }else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    exit;
}

/**
 * Converts special characters to HTML entities
 * @param string $str string to convert
 * @return string
 */
function hsc(string $str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}