<?php


namespace tools\core\base;


abstract class Model
{
    /** @var array  */
    protected array $fields = [];

    /**
     * Model constructor.
     * @param $fields
     * @param bool $load
     */
    public function __construct($fields, $load = true)
    {
        $load === true ? $this->load($fields) : $this->save($fields);
    }

    /**
     * @param $data
     */
    abstract protected function load($data);

    /**
     * @param $data
     */
    abstract protected function save($data);

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

    /**
     * @return array
     */
    public function getAllFields()
    {
        return $this->fields;
    }
}