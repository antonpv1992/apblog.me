<?php


namespace tools\core\mappers;


use tools\core\base\Mapper;

class ContactMapper extends Mapper
{
    /** @var string  */
    protected $table = 'contact';

    /** @var string  */
    protected $key = 'user';

    /**
     * @param $data
     * @param $flag
     * @return \app\models\User
     */
    public function fieldToContact($data, $flag)
    {
        return \app\models\User::rowFromData($data, $flag);
    }

    /**
     * @param $data
     * @param $flag
     * @return array
     */
    public function fieldsToContact($data, $flag)
    {
        return \app\models\User::rowsFromData($data, $flag);
    }

    /**
     * @param $fields
     * @param false $condition
     * @return mixed
     */
    public function updateContactField($fields, $condition = false)
    {
        $condition = $condition !== false ? " WHERE " . $condition : "";
        return $this->query("UPDATE $this->table SET $fields $condition");
    }
}