<?php


namespace app\models;


use tools\core\base\Model;

abstract class AppModel extends Model
{

    /**
     * method for converting a string from db to object
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return static object
     */
    public static function rowFromData(array $data, bool $flag): static
    {
        return empty($data) ? new static($data, $flag) : new static($data[0], $flag);
    }

    /**
     * method for converting a string from db to an array of objects
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return array array of objects
     */
    public static function rowsFromData(array $data, bool $flag): array
    {
        $objects = [];
        foreach ($data as $object) {
            array_push($objects, new static($object, $flag));
        }
        return $objects;
    }
}