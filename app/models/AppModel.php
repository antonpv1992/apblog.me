<?php


namespace app\models;


use tools\core\base\Model;

abstract class AppModel extends Model
{
    /**
     * @param array $data
     * @param $flag
     * @return static
     */
    public static function rowFromData(array $data, $flag)
    {
        return empty($data) ? new static($data, $flag) : new static($data[0], $flag);
    }

    /**
     * @param array $data
     * @param $flag
     * @return array
     */
    public static function rowsFromData(array $data, $flag)
    {
        $objects = [];
        foreach ($data as $object) {
            array_push($objects, new static($object, $flag));
        }
        return $objects;
    }
}