<?php

namespace tools\core\mappers;

use app\models\User;
use tools\core\base\Mapper;

class UserMapper extends Mapper
{

    /** @var string table name */
    protected string $table = 'user';

    /** @var string key name */
    protected string $key = 'id';

    /**
     * method for converting data from db to model data
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return User object
     */
    public function fieldToUser(array $data, bool $flag = true): User
    {
        return User::rowFromData($data, $flag);
    }

    /**
     * method for converting data from db to array data of models
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return array array of objects
     */
    public function fieldsToUser(array $data, bool $flag = true): array
    {
        return User::rowsFromData($data, $flag);
    }

    /**
     * method that checks by login if the user exists
     * @param string $login current login
     * @return bool true if exists
     */
    public function isUserExists(string $login): bool
    {
        return $this->storage->exists("SELECT login FROM $this->table WHERE login = ?", [$login]);
    }

    /**
     * method that checks by email if the user exists
     * @param string $email current email
     * @return bool true if exists
     */
    public function isEmailExists(string $email): bool
    {
        return $this->storage->exists("SELECT email FROM $this->table WHERE email = ?", [$email]);
    }

    /**
     * method to get all users
     * @return array objects
     */
    public function getAll(): array
    {
        return $this->fieldsToUser($this->storage->query("SELECT * from $this->table"));
    }

    /**
     * method that returns one user by value
     * @param string $value search value
     * @param string $field value field
     * @return User object
     */
    public function getOne(string $value, string $field = ''): User
    {
        return $this->fieldToUser($this->findOne($value, $field));
    }

    /**
     * method that returns the user by condition
     * @param bool|string $fields fields
     * @param bool|string $condition search term
     * @return User object
     */
    public function getUser(bool|string $fields = false, bool|string $condition = false): User
    {
        $fields = $fields !== false ? $fields : "*";
        $condition = $condition !== false ? " WHERE $condition" : "";
        return $this->fieldToUser($this->query("SELECT $fields FROM $this->table $condition"));
    }

    /**
     * retrieving user data from several tables by condition
     * @param string $fields fields
     * @param bool|string $condition search term
     * @param bool|string $order ordering conditions
     * @param bool|string $limit field limit
     * @return array objects
     */
    public function getUsers(
        string $fields,
        bool|string $condition = false,
        bool|string $order = false,
        bool|string $limit = false
    ): array
    {
        $condition = $condition !== false ? " WHERE " . $condition : "";
        $limit = $limit !== false ? " LIMIT " . $limit : "";
        $order = $order !== false ? " ORDER BY " . $order : "";
        return $this->fieldsToUser(
            $this->query(
                "SELECT $fields FROM $this->table INNER JOIN contact ON user.id = contact.user $condition $order $limit"
            )
        );
    }

    /**
     * method that updates the fields of the user's table
     * @param string $fields fields
     * @param bool|string $condition search term
     * @return array objects
     */
    public function updateUserField(string $fields, bool|string $condition = false): array
    {
        $condition = $condition !== false ? " WHERE " . $condition : "";
        return $this->query("UPDATE $this->table SET $fields $condition");
    }
}