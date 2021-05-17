<?php

namespace tools\core\mappers;

use app\models\Activity;
use tools\core\base\Mapper;

class ActivityMapper extends Mapper
{

    /** @var string table name */
    protected string $table = 'activity';

    /** @var string key name */
    protected string $key = '';

    /**
     * method for converting data from db to model data
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return Activity object
     */
    public function fieldToActivity(array $data, bool $flag): Activity
    {
        return Activity::rowFromData($data, $flag);
    }

    /**
     * method for converting data from db to array data of models
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return array array of objects
     */
    public function fieldsToActivity(array $data, bool $flag): array
    {
        return Activity::rowsFromData($data, $flag);
    }

    /**
     * method for adding user activity to table
     * @param array $params array of parameters
     */
    public function addActivity(array $params = []): void
    {
        $this->save($params);
    }

    /**
     * method for changing data in the database for a specific field
     * @param string $fields fields to update
     * @param string $condition renewal conditions
     */
    public function setActivity(string $fields, string $condition): void
    {
        $this->execute("UPDATE $this->table SET $fields WHERE $condition");
    }

}