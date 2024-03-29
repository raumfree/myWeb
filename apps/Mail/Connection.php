<?php

namespace apps\Mail;

use apps\Configuration;

class ConnectionMail extends Configuration
{
    private $imap;
    private  static $connection = null;


    private function connecting(){
        echo "[LOG] Connecting to the mail...\n";
        $config =  $this->get_ini_config();
        $this->imap = imap_open($config['serverName'],$config['mail'],$config['mailPassword']);

        if (!$this->imap){
            echo "[LOG] Gmail connection failed.\n";
            die();
        }

        echo "[LOG] Gmail connection is successful.\n";

    }

    public function get_messages()
    {
        $this->connecting();
        $mails = imap_search($this->imap, 'UNSEEN');

        echo "[LOG] Checking your mail.\n";

        if (!$mails){
            echo "[LOG] There are no new messages.\n";
            return;
        }

        echo "[LOG] Message analysis...\n";

        $mails_arr = array();
        foreach ($mails as $num){
            $letter = mb_decode_mimeheader(imap_headerinfo($this->imap, $num)->subject);

            if (preg_match("/[a-zA-Z]+\.[a-z]+ - [a-zA-Zа-яА-Я1-9]/", $letter)){
                $mails_arr[] = imap_headerinfo($this->imap, $num);
                imap_setflag_full($this->imap, $num, "\\Seen");
            }
        }
        imap_close($this->imap);

        if ($mails_arr){
            echo "[LOG] " . count($mails_arr) . " valid emails found.\n";
        }else{
            echo "[LOG] The emails are not valid.\n";
        }

        return $mails_arr;
    }

    public static function get_connection()
    {
        if (static::$connection === null) {
            static::$connection = new self();
        }
        return static::$connection;
    }

}