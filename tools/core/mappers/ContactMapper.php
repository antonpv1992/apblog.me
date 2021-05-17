<?php

namespace tools\core\mappers;

use app\models\Contact;
use tools\core\base\Mapper;

class ContactMapper extends Mapper
{

    /** @var string table name */
    protected string $table = 'contact';

    /** @var string key name */
    protected string $key = 'user';

    /**
     * method for converting data from db to model data
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return Contact object
     */
    public function fieldToContact(array $data, bool $flag): Contact
    {
        return Contact::rowFromData($data, $flag);
    }

    /**
     * method for converting data from db to array data of models
     * @param array $data data array
     * @param bool $flag flag for loading / unloading data from database or fields
     * @return array array of objects
     */
    public function fieldsToContact(array $data, bool $flag): array
    {
        return Contact::rowsFromData($data, $flag);
    }

    /**
     * method for updating contact information
     * @param string $fields fields to update
     * @param string|bool $condition renewal conditions
     * @return array data
     */
    public function updateContactField(string $fields, string|bool $condition = false): array
    {
        $condition = $condition !== false ? " WHERE " . $condition : "";
        return $this->query("UPDATE $this->table SET $fields $condition");
    }
}