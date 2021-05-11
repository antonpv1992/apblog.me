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
     * @return array
     */
    public function getAllFields()
    {
        return $this->fields;
    }
}