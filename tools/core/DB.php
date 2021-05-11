<?php


namespace tools\core;


class DB
{
    /** @var mixed db json file */
    private $db;
    /** @var DB object instance */
    private static DB $instance;

    /**
     * creation / receiving object instance
     * @return DB object instance
     */
    public static function instance(): DB
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * DB constructor.
     */
    protected function __construct()
    {
        $this->db = json_decode(file_get_contents(CONF . '/db.json'), true);
    }

    /**
     * method for getting a specific schema from a file
     * @param string $scheme name
     * @return array|null array if scheme exists
     */
    public static function scheme(string $scheme): ?array
    {
        if(!empty(self::$instance->db[$scheme])){
            return self::$instance->db[$scheme];
        }
        return null;
    }
}