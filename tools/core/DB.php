<?php

namespace tools\core;

class Db
{
    /** @var \PDO storage variable*/
    protected \PDO $db;

    /** @var string scheme name */
    protected string $scheme = "trainee_blog";

    /** @var null instance db*/
    private static $instance;

    /**
     * @return Db
     */
    public static function instance(): Db
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Db constructor.
     */
    protected function __construct()
    {
        $config = require_once CONF . '/dbconfig.php';
        $options = [
            //\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->db = new \PDO($config['dsn'], $config['user'], $config['pass'], $options);
    }

    /**
     * method for getting the last id written to the database
     * @return string last id
     */
    public function lastID(): string
    {
        return $this->db->lastInsertId();
    }

    /**
     * method for executing sql query
     * @param string $sql query
     * @param array $params parameters
     */
    public function execute(string $sql, array $params = []): void
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * method for checking for the existence of a field in the database
     * @param string $sql query
     * @param array $params parameters
     * @return bool true if exists
     */
    public function exists(string $sql, array $params = []): bool
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        if($stmt->fetch()) {
            return true;
        }
        return false;
    }

    /**
     * method for checking the existence of a column
     * @param string $table table name
     * @param string $col column name
     * @return int|string number of coincidences
     */
    public function colExists(string $table, string $col): int|string
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM information_schema.COLUMNS WHERE COLUMN_NAME = '$col' AND TABLE_NAME = '$table' AND TABLE_SCHEMA = '$this->scheme'");
        $result = $stmt->execute();
        if($result !== false){
            return $stmt->fetch()['count(*)'];
        }
        return 0;
    }

    /**
     * method for querying the database by query with parameters
     * @param string $sql query
     * @param array $params parameters
     * @return array data
     */
    public function query(string $sql, array $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($params);
        if($result !== false){
            return $stmt->fetchAll();
        }
        return [];
    }

    /**
     * method for finding a column
     * @param string $sql query
     * @param array $params parameters
     * @return array data
     */
    public function queryCol(string $sql, array $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($params);
        if($result !== false){
            return $stmt->fetchColumn();
        }
        return [];
    }

    /**
     * method for saving data to database
     * @param string $table table name
     * @param array $params parameters
     */
    public function save(string $table, array $params): void
    {
        $arr = getFieldsAndKeys($params);
        $sql = "INSERT INTO $table (" . $arr['fields'] . ") VALUES (" . $arr['keys'] . ")";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * method for updating data in the database
     * @param string $table table name
     * @param string $params parameters
     * @param string $param search parameter
     * @param string $field search field
     */
    public function update(string $table, string $params, string $param, string $field): void
    {
        $pairs = setFieldsAndKeys($params);
        $sql = "UPDATE $table SET $pairs WHERE $field = $param";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * method for deleting data from the database
     * @param string $table table name
     * @param array $params parameters
     */
    public function remove(string $table, $params = []): void
    {
        $pairs = setFieldsAndKeys($params);
        $sql = "DELETE FROM $table WHERE $pairs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }
}