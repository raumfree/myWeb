<?php

namespace apps\Mail;

use apps\Configuration;

class ConnectionMail extends Configuration
{
    private $imap;
    private  static $connection = null;


    function __construct(){
        echo "[LOG] Connecting to the mail...\n";
        $config =  $this->get_ini_config();
        $this->imap = imap_open($config['serverName'],$config['mail'],$config['mailPassword']);

        if ($this->imap){
            echo "[LOG] Gmail connection is successful.\n";
        }else{
            echo "[LOG] Gmail connection failed.\n";
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