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
        if (!$array_messages){
            return null;
        }
        echo "[LOG] Creating an SQL query.\n";
        $request = "INSERT INTO public.task (domen, name_form, date_time) VALUES ";
        foreach ($array_messages as $message){
            $header = explode("-", mb_decode_mimeheader($message->subject));
            $request .= sprintf(
                "( '%s'::text, '%s'::text, '%s'::timestamp without time zone),",
                htmlspecialchars(trim($header[0])),
                htmlspecialchars(ltrim($header[1])),
                htmlspecialchars(substr($message->MailDate,0,-6))
            );
        }
        $request = substr($request,0,-1);
        echo "[LOG] SQL query: " . $request . "\n";
        $this->pdo->query($request);
        echo "[LOG] Saved to the database. \n";
    }

    public static function get_connection()
    {
        if (static::$connection === null) {
            static::$connection = new self();
        }
        return static::$connection;
    }
}