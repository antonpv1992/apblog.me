<?php


namespace tools\core\mappers;


use tools\core\base\Mapper;

class ActivityMapper extends Mapper
{
    /** @var string  */
    protected $table = 'activity';

    /** @var string  */
    protected $key = '';

    /**
     * @param $data
     * @param $flag
     * @return \app\models\User
     */
    public function fieldToActivity($data, $flag)
    {
        return \app\models\User::rowFromData($data, $flag);
    }

    /**
     * @param $data
     * @param $flag
     * @return array
     */
    public function fieldsToActivity($data, $flag)
    {
        return \app\models\User::rowsFromData($data, $flag);
    }

    /**
     * @param array $params
     */
    public function addActivity($params = [])
    {
        $this->save($params);
    }

    /**
     * @param $fields
     * @param $condition
     */
    public function setActivity($fields, $condition)
    {
        $this->query("UPDATE $this->table SET $fields WHERE $condition");
    }
}