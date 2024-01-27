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

    public function get_messages()
    {
        $mails = imap_search($this->imap, 'UNSEEN');
        echo "[LOG] Checking your mail.\n";
        if (!$mails){
            echo "[LOG] There are no new messages.\n";
            return null;
        }
        echo "[LOG] Message analysis...\n";
        $mails_arr = array();
        foreach ($mails as $num){
            $letter = mb_decode_mimeheader(imap_headerinfo($this->imap, $num)->subject);

            if (preg_match("/[a-zA-Z]+\.[a-z]+ - [a-zA-Zа-яА-Я]/", $letter)){
                $mails_arr[] = imap_headerinfo($this->imap, $num);
                //imap_setflag_full($this->imap, $num, "\\Seen");
            }
        }

        if ($mails_arr){
            echo "[LOG] " . count($mails_arr) . " valid emails found. \n";
            return $mails_arr;
        }else{
            echo "[LOG] The emails are not valid.\n";
            return null;
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