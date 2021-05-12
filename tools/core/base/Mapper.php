<?php


namespace tools\core\base;


abstract class Mapper
{
    /** @var .data store */
    protected $storage;

    /** @var  */
    protected $table;

    /** @var string  */
    protected $key = 'id';

    /**
     * Mapper constructor.
     * @param $storage
     */
    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
    public function query($sql, $params = []){
        return $this->storage->query($sql, $params);
    }

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function issExists($field, $value)
    {
        return $this->storage->execute("SELECT $field FROM $this->table WHERE $field = ?", $value);
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function isExists($fields)
    {
        return $this->storage->exists("SELECT * FROM $this->table WHERE $fields");
    }

    /**
     * @param $col
     * @return mixed
     */
    public function isCol($col)
    {
        return $this->storage->colExists($this->table, $col);
    }

    /**
     * @param $data
     */
    public function save($data)
    {
        $this->storage->save($this->table, $data);
    }

    /**
     * @param $data
     * @param $param
     * @param false $key
     */
    public function updat($data, $param, $key = false)
    {
        $key = $key !== false ? $key : $this->key;
        $this->storage->update($this->table, $data, $param, $key);
    }

    /**
     * @param $params
     * @param false $condition
     */
    public function update($params, $condition = false)
    {
        $condition = $condition !== false ? "WHERE $condition" : "";
        $this->storage->query("UPDATE $this->table SET $params $condition");
    }

    /**
     * @param false $condition
     * @return mixed
     */
    public function countRecords($condition = false)
    {
        $condition = $condition !== false ? "WHERE $condition" : "";
        return $this->storage->query("SELECT COUNT(*) FROM $this->table $condition")[0]['COUNT(*)'] ;
    }

    /**
     * @param $data
     */
    public function delete($data)
    {
        $this->storage->remove($this->table, $data);
    }

    /**
     * @return mixed
     */
    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        return $this->storage->query($sql);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function findOne($value, $field = '')
    {
        $field = $field ?: $this->key;
        $sql = "SELECT * FROM $this->table WHERE $field = ? LIMIT 1";
        return $this->storage->query($sql, [$value]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function findColls($key)
    {
        $key = $key ?: $this->key;
        $sql = "SELECT $key FROM $this->table";
        return $this->storage->queryCol($sql);
    }

    /**
     * @param $key
     * @param string $field
     * @return mixed
     */
    public function findOneColl($key, $field = '')
    {
        $key = $key ?: $this->key;
        $sql = "SELECT $key FROM $this->table WHERE $field = ? LIMIT 1";
        return $this->storage->queryCol($sql, [$key]);
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
    public function findBySql($sql, $params = []){
        return $this->storage->query($sql, $params);
    }

    /**
     * @param $str
     * @param $field
     * @param string $table
     * @return mixed
     */
    public function findLike($str, $field, $table = ''){
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->storage->query($sql, ['%' . $str . '%']);
    }
}