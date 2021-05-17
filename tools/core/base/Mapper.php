<?php

namespace tools\core\base;

use tools\core\Db;

abstract class Mapper
{
    /** @var DB object*/
    protected DB $storage;

    /** @var string current table*/
    protected string $table;

    /** @var string current key */
    protected string $key = 'id';

    /**
     * Mapper constructor.
     * @param DB $storage
     */
    public function __construct(DB $storage)
    {
        $this->storage = $storage;
    }

    /**
     * method for direct sql request
     * @param string $sql query
     * @param array $params request parameters
     * @return array data from the database as an array
     */
    public function query(string $sql, array $params = []): array
    {
        return $this->storage->query($sql, $params);
    }

    /**
     * method for direct sql request
     * @param string $sql query
     * @param array $params request parameters
     */
    public function execute(string $sql, array $params = []): void
    {
        $this->storage->execute($sql, $params);
    }

    /**
     * the method is needed to check for the existence of data in the database
     * @param string $fields fields to be checked
     * @return bool result
     */
    public function isExists(string $fields): bool
    {
        return $this->storage->exists("SELECT * FROM $this->table WHERE $fields");
    }

    /**
     * method for checking if such a column exists in the database
     * @param string $col column name
     * @return int|mixed column or 0
     */
    public function isCol(string $col): int|null
    {
        return $this->storage->colExists($this->table, $col);
    }

    /**
     * method for saving data to tables
     * @param array $data data to save
     */
    public function save(array $data): void
    {
        $this->storage->save($this->table, $data);
    }

    /**
     * method for updating data in a table
     * @param string $params parameters (fields) to update
     * @param string|bool $condition conditions necessary for updating
     */
    public function update(string $params, string|bool $condition = false): void
    {
        $condition = $condition !== false ? "WHERE $condition" : "";
        $this->storage->query("UPDATE $this->table SET $params $condition");
    }

    /**
     * the method is needed to count the records in the table
     * @param string|bool $condition conditions necessary for counting
     * @return int|string number of records
     */
    public function countRecords(string|bool $condition = false): int|string
    {
        $condition = $condition !== false ? "WHERE $condition" : "";
        return $this->storage->query("SELECT COUNT(*) FROM $this->table $condition")[0]['COUNT(*)'] ;
    }

    /**
     * method for deleting an entry from the database
     * @param array $data data array
     */
    public function delete(array $data): void
    {
        $this->storage->remove($this->table, $data);
    }

    /**
     * method to find all fields in a table
     * @return array data array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->storage->query($sql);
    }

    /**
     * method that returns one record from the database
     * @param string $value search value
     * @param string $field search field
     * @return array data
     */
    public function findOne(string $value, $field = ''): array
    {
        $field = $field ?: $this->key;
        $sql = "SELECT * FROM $this->table WHERE $field = ? LIMIT 1";
        return $this->storage->query($sql, [$value]);
    }

    /**
     * method for finding columns by title
     * @param string $key column name
     * @return array data
     */
    public function findColls(string $key): array
    {
        $key = $key ?: $this->key;
        $sql = "SELECT $key FROM $this->table";
        return $this->storage->queryCol($sql);
    }

    /**
     * method for finding one column from the database
     * @param string $key column name
     * @param string $field search fields
     * @return array data
     */
    public function findOneColl(string $key, string $field = ''): array
    {
        $key = $key ?: $this->key;
        $sql = "SELECT $key FROM $this->table WHERE $field = ? LIMIT 1";
        return $this->storage->queryCol($sql, [$key]);
    }

    /**
     * sql search
     * @param string $sql query
     * @param array $params parameters
     * @return array data
     */
    public function findBySql(string $sql, array $params = []): array
    {
        return $this->storage->query($sql, $params);
    }

    /**
     * method for searching by expression
     * @param string $str substrings for search
     * @param string $field search field
     * @param string $table table name
     * @return array data
     */
    public function findLike(string $str, string $field, string $table = ''): array
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->storage->query($sql, ['%' . $str . '%']);
    }
}