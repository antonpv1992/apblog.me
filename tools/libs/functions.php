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

/**
 * @param string $text
 * @return string
 */
function transliterate(string $text)
{
    $alphabet = array(
        "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
        "е"=>"e", "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i",
        "й"=>"i","к"=>"k","л"=>"l", "м"=>"m","н"=>"n",
        "о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
        "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch",
        "ш"=>"sh","щ"=>"sh","ы"=>"i","э"=>"e","ю"=>"u",
        "я"=>"ya",
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
        "Е"=>"E","Ё"=>"Yo","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"Y","Ф"=>"F","Х"=>"H","Ц"=>"C","Ч"=>"Ch",
        "Ш"=>"Sh","Щ"=>"Sh","Ы"=>"I","Э"=>"E","Ю"=>"U",
        "Я"=>"Ya",
        "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"",
        "ї"=>"j","і"=>"i","ґ"=>"g","є"=>"ye",
        "Ї"=>"J","І"=>"I","Ґ"=>"G","Є"=>"YE"
    );
    $symbols = ["-", "_", "/", "\\", "@", "$", "^", "&", "*", "~", "`"];
    return str_ireplace($symbols, "-", strtr($text, $alphabet));
}

/**
 * @param string $text
 * @return string
 */
function generateAlias(string $text)
{
    return strtolower(implode("-", array_filter(explode(' ', transliterate($text)), function ($key){
        return $key !== "-";
    })));
}

/**
 * @param string $alias
 * @return string
 */
function aliasCollision(string $alias)
{
    $array = explode("-", $alias);
    if(is_numeric($array[count($array) - 1])){
        $array[count($array) - 1]++;
    } else {
        array_push($array, '1');
    };
    return implode("-", $array);
}

/**
 * @param $data
 * @return string
 */
function generateFields($data)
{
    $str = '';
    foreach($data as $key => $value) {
        $str .= $key . ', ';
    }
    return substr($str, 0, -2);
}

/**
 * @param $data
 * @return string[]
 */
function getFieldsAndKeys($data)
{
    $arr = ['fields' => "", 'keys' => ""];
    foreach ($data as $key => $value) {
        $arr['fields'] .= $key . ", ";
        $arr['keys'] .= ":" . $key . ", ";
    }
    $arr['fields'] = substr(rtrim($arr['fields']), 0, -1);
    $arr['keys'] = substr(rtrim($arr['keys']), 0, -1);
    return $arr;
}

/**
 * @param $data
 * @return string
 */
function setFieldsAndKeys($data)
{
    $str = '';
    foreach($data as $key => $value){
        $str .= "$key = :$key, ";
    }
    $str = substr(rtrim($str), 0, -1);
    return $str;
}