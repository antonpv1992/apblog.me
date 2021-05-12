<?php

namespace tools\core\mappers;

use tools\core\base\Mapper;

class UserMapper extends Mapper
{
    /** @var string  */
    protected $table = 'user';

    /** @var string  */
    protected $key = 'id';

    /**
     * @param $data
     * @param bool $flag
     * @return \app\models\User
     */
    public function fieldToUser($data, $flag = true)
    {
        return \app\models\User::rowFromData($data, $flag);
    }

    /**
     * @param $data
     * @param bool $flag
     * @return array
     */
    public function fieldsToUser($data, $flag = true)
    {
        return \app\models\User::rowsFromData($data, $flag);
    }

    /**
     * @param $login
     * @return mixed
     */
    public function isUserExists($login)
    {
        return $this->storage->exists("SELECT login FROM $this->table WHERE login = ?", [$login]);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function isEmailExists($email)
    {
        return $this->storage->exists("SELECT email FROM $this->table WHERE email = ?", [$email]);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->fieldsToUser($this->storage->query("SELECT * from $this->table"));
    }

    /**
     * @param $value
     * @param string $field
     * @return \app\models\User
     */
    public function getOne($value, $field = '')
    {
        return $this->fieldToUser($this->findOne($value, $field));
    }

    /**
     * @param false $fields
     * @param false $condition
     * @return \app\models\User
     */
    public function getUser($fields = false, $condition = false)
    {
        $fields = $fields !== false ? $fields : "*";
        $condition = $condition !== false ? " WHERE $condition" : "";
        return $this->fieldToUser($this->query("SELECT $fields FROM $this->table $condition"));
    }

    /**
     * @param $fields
     * @param false $condition
     * @param false $order
     * @param false $limit
     * @return array
     */
    public function getUsers($fields, $condition = false, $order = false, $limit = false)
    {
        $condition = $condition !== false ? " WHERE " . $condition : "";
        $limit = $limit !== false ? " LIMIT " . $limit : "";
        $order = $order !== false ? " ORDER BY " . $order : "";
        return $this->fieldsToUser($this->query("SELECT $fields FROM $this->table INNER JOIN contact ON user.id = contact.user $condition $order $limit"));
    }

    /**
     * @param $fields
     * @param false $condition
     * @return mixed
     */
    public function updateUserField($fields, $condition = false)
    {
        $condition = $condition !== false ? " WHERE " . $condition : "";
        return $this->query("UPDATE $this->table SET $fields $condition");
    }
}