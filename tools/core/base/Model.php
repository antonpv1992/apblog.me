<?php

namespace tools\core\base;

abstract class Model
{
    /** @var array array of class fields */
    protected array $fields;

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
     * method for loading data from the database
     * @param array $data data array
     */
    abstract protected function load(array $data): void;

    /**
     * method for saving data to database
     * @param array $data data array
     */
    abstract protected function save(array $data): void;

    /**
     * method which returns all fields of the model
     * @return array model fields
     */
    public function getAllFields(): array
    {
        return $this->fields;
    }
}