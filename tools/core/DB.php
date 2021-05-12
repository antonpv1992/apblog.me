<?php


namespace tools\core;


class DB
{
    /** @var \PDO  */
    protected $db;

    /** @var string  */
    protected $scheme = "trainee_blog";

    //** @var .object instance */
    private static $instance;

    /**
     * creation / receiving object instance
     * @return .object instance
     */
    public static function instance()
    {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * DB constructor.
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
     * @return string
     */
    public function lastID()
    {
        return $this->db->lastInsertId();
    }

    /**
     * @param $sql
     * @param array $params
     */
    public function execute($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * @param $sql
     * @param array $params
     * @return bool
     */
    public function exists($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        if($stmt->fetch()) {
            // exists
            return true;//'существует!';
        }
        return false;//'запихивай!';
    }

    /**
     * @param $table
     * @param $col
     * @return int|mixed
     */
    public function colExists($table, $col)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM information_schema.COLUMNS WHERE COLUMN_NAME = '$col' AND TABLE_NAME = '$table' AND TABLE_SCHEMA = '$this->scheme'");
        $result = $stmt->execute();
        if($result !== false){
            return $stmt->fetch()['count(*)'];
        }
        return 0;
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($params);
        if($result !== false){
            return $stmt->fetchAll();
        }
        return [];
    }

    /**
     * @param $sql
     * @param array $params
     * @return array|mixed
     */
    public function queryCol($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($params);
        if($result !== false){
            return $stmt->fetchColumn();
        }
        return [];
    }

    /**
     * @param $table
     * @param $params
     */
    public function save($table, $params)
    {
        $arr = getFieldsAndKeys($params);
        $sql = "INSERT INTO $table (" . $arr['fields'] . ") VALUES (" . $arr['keys'] . ")";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * @param $table
     * @param $params
     * @param $param
     * @param $field
     */
    public function update($table, $params, $param, $field)
    {
        $pairs = setFieldsAndKeys($params);
        $sql = "UPDATE $table SET $pairs WHERE $field = $param";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * @param $table
     * @param $params
     */
    public function remove($table, $params)
    {
        $pairs = setFieldsAndKeys($params);
        $sql = "DELETE FROM $table WHERE $pairs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }
}