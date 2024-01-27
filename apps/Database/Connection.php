<?php

namespace apps\Database;

require "apps\Configuration.php";

use apps\Configuration;

class ConnectionDB extends Configuration
{

    protected $pdo = null;
    private  static $connection = null;

    function __construct()
    {
        echo "[LOG] Connecting to the database...\n";
        $config =  $this->get_ini_config();
        $parameters = sprintf(
            "pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $config['host'],
            $config['port'],
            $config['database'],
            $config['user'],
            $config['password']
        );

        $this->pdo = new \PDO($parameters);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        echo "[LOG] The connection to the database was successful.\n";

        return $this->pdo;
    }

    public function query($array_messages)
    {
        foreach($array_messages as $letter){
            //
        }
    }

    public static function get_connection()
    {
        if (static::$connection === null) {
            static::$connection = new self();
        }
        return static::$connection;
    }
}