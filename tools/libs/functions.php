<?php
/**
 * method for debug outputting an array
 * @param $arr array to display
 */
function debug(array $arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}