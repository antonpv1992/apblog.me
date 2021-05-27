<?php

/**
 * method for debug outputting an array
 * @param array $arr array to display
 */
function debug(array $arr): void
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

/**
 * method for converting names to CamelCase
 * @param string $name
 * @return string CamelCase
 */
function upperCamelCase(string $name): string
{
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
}

/**
 * method for converting names to camelCase
 * @param string $name
 * @return string camelCase
 */
function lowerCamelCase(string $name): string
{
    return lcfirst(upperCamelCase($name));
}

/**
 * route redirecting method
 * @param bool|string $http link
 */
function redirect(bool|string $http = false): void
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = $_SERVER['HTTP_REFERER'] ?? '/';
    }
    header("Location: $redirect");
    exit();
}

/**
 * Converts special characters to HTML entities
 * @param string $str string to convert
 * @return string
 */
function hsc(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES);
}

/**
 * method for replacing the Cyrillic alphabet with the Latin alphabet
 * @param string $text text to convert
 * @return string converted string
 */
function transliterate(string $text): string
{
    $alphabet = array(
        "а" => "a",
        "б" => "b",
        "в" => "v",
        "г" => "g",
        "д" => "d",
        "е" => "e",
        "ё" => "yo",
        "ж" => "j",
        "з" => "z",
        "и" => "i",
        "й" => "i",
        "к" => "k",
        "л" => "l",
        "м" => "m",
        "н" => "n",
        "о" => "o",
        "п" => "p",
        "р" => "r",
        "с" => "s",
        "т" => "t",
        "у" => "y",
        "ф" => "f",
        "х" => "h",
        "ц" => "c",
        "ч" => "ch",
        "ш" => "sh",
        "щ" => "sh",
        "ы" => "i",
        "э" => "e",
        "ю" => "u",
        "я" => "ya",
        "А" => "A",
        "Б" => "B",
        "В" => "V",
        "Г" => "G",
        "Д" => "D",
        "Е" => "E",
        "Ё" => "Yo",
        "Ж" => "J",
        "З" => "Z",
        "И" => "I",
        "Й" => "I",
        "К" => "K",
        "Л" => "L",
        "М" => "M",
        "Н" => "N",
        "О" => "O",
        "П" => "P",
        "Р" => "R",
        "С" => "S",
        "Т" => "T",
        "У" => "Y",
        "Ф" => "F",
        "Х" => "H",
        "Ц" => "C",
        "Ч" => "Ch",
        "Ш" => "Sh",
        "Щ" => "Sh",
        "Ы" => "I",
        "Э" => "E",
        "Ю" => "U",
        "Я" => "Ya",
        "ь" => "",
        "Ь" => "",
        "ъ" => "",
        "Ъ" => "",
        "ї" => "j",
        "і" => "i",
        "ґ" => "g",
        "є" => "ye",
        "Ї" => "J",
        "І" => "I",
        "Ґ" => "G",
        "Є" => "YE"
    );
    $symbols = ["-", "_", "/", "\\", "@", "$", "^", "&", "*", "~", "`"];
    return str_ireplace($symbols, "-", strtr($text, $alphabet));
}

/**
 * method for generating alas
 * @param string $text text for generation
 * @return string generated alias
 */
function generateAlias(string $text): string
{
    return strtolower(
        implode(
            "-",
            array_filter(
                explode(' ', transliterate($text)),
                function ($key) {
                    return $key !== "-";
                }
            )
        )
    );
}

/**
 * alias changes on collision
 * @param string $alias current alias
 * @return string new alias
 */
function aliasCollision(string $alias): string
{
    $array = explode("-", $alias);
    if (is_numeric($array[count($array) - 1])) {
        $array[count($array) - 1]++;
    } else {
        array_push($array, '1');
    }
    return implode("-", $array);
}

/**
 * method for generating fields for insertion into the database
 * @param array $data
 * @return string fields
 */
function generateFields(array $data): string
{
    $str = '';
    foreach ($data as $key => $value) {
        $str .= $key . ', ';
    }
    return substr($str, 0, -2);
}

/**
 *  method for generating fields for insertion into the database
 * @param array $data
 * @return array fields
 */
function getFieldsAndKeys(array $data): array
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
 * method for generating fields for insertion into the database
 * @param array $data
 * @return string fields
 */
function setFieldsAndKeys(array $data): string
{
    $str = '';
    foreach ($data as $key => $value) {
        $str .= "$key = :$key, ";
    }
    return substr(rtrim($str), 0, -1);
}

/**
 * method for randomly generating a password
 * @return string generated password
 */
function generatePassword(): string
{
    $min_length = 11; //Minimum length of the password
    $min_numbers = 2; //Minimum of numbers AND special characters
    $min_letters = 2; //Minimum of letters
    $password = '';
    $numbers = 0;
    $letters = 0;
    $length = 0;
    while ($length <= $min_length or $numbers <= $min_numbers or $letters <= $min_letters) {
        $length += 1;
        $type = rand(1, 3);
        if ($type == 1) {
            $password .= chr(rand(48, 57)); //Numbers
            $numbers += 1;
        } elseif ($type == 2) {
            $password .= chr(rand(65, 90)); //A->Z
            $letters += 1;
        } else {
            $password .= chr(rand(97, 122)); //a->z
            $letters += 1;
        }
    }
    return $password;
}

/**
 * converting string to camelToSlesh
 * @param string $text
 * @return string
 */
function camelToSlesh(string $text): string
{
    $temp = preg_split('/(?<=[а-я,a-z])(?=[А-Я,A-Z])/u', $text);
    return strtolower(implode('-', $temp));
}

/**
 * converting string to sleshToCamel
 * @param string $text
 * @return string
 */
function sleshToCamel(string $text): string
{
    $temp = explode('-', $text);
    $res = $temp[0];
    for ($i = 1; $i < count($temp); $i++) {
        $res .= ucfirst($temp[$i]);
    }
    return $res;
}

/**
 * method for outputting the multiplication table
 * @param bool $color color the table or not
 */
function outputTable($color = false): void
{
    echo '<tr class="content__table-row">';
    for ($i = 1; $i <= 10; $i++) {
        if ($i === 6) {
            echo '</tr>';
            echo '<tr class="content__table-row">';
        }
        echo '<td class="content__table-col">';
        for ($j = 1; $j <= 10; $j++) {
            echo($color ? getColor($i) . ' x ' . getColor($j) . ' = ' . getColor(
                    $i * $j
                ) . '<br>' : $i . ' x ' . $j . ' = ' . $i * $j . '<br>');
        }
        echo '</td>';
    }
    echo '</tr>';
}

/**
 * method for correct color acquisition
 * @param int $number
 * @return string html color variant
 */
function getColor(int $number): string
{
    $colors = COLORS;
    $result = '';
    $tagsContainer = [];
    $count = 0;
    while (strlen((string)$number) !== 1) {
        $tagsContainer[$count] = "<span class='{$colors[$number % 10]}'>" . $number % 10 . '</span>';
        $count++;
        $number = floor($number / 10);
    }
    $tagsContainer[$count] = "<span class='{$colors[$number % 10]}'>" . $number % 10 . '</span>';
    for ($i = $count; $i >= 0; $i--) {
        $result .= $tagsContainer[$i];
    }
    return $result;
}

/**
 * method for coloring text
 * @param string $str
 */
function paintWord(string $str): void
{
    $letters = preg_split('/(?<!^)(?!$)/u', $str);
    $colors = COLORS;
    $text = '';
    for ($i = 0, $j = 0; $i < count($letters); $i++, $j++) {
        if ($j >= 10) {
            $j = 0;
        }
        $text .= "<span class='{$colors[$j]}'>" . $letters[$i] . '</span>';
    }
    echo $text;
}

/**
 * method for reversing the string
 * @param string $str
 * @return string inverted string
 */
function mb_strrev(string $str): string
{
    $letters = preg_split("//u", htmlspecialchars($str), 0, PREG_SPLIT_NO_EMPTY);
    return join("", array_reverse($letters));
}