<?php

namespace apps;

class Configuration
{
    protected $config = null;

    protected function get_ini_config()
    {
        if ($this->config === null){
            echo "[LOG] Reading config.ini.\n";
            $this->config = parse_ini_file("config/config.ini");
            if ($this->config === false){
                echo "[LOG] The file could not be read config.ini.";
            }
            return $this->config;
        }else{
            echo "[LOG] Return config.ini.\n";
            return $this->config;
        }
    }

    public static function get_connection()
    {
        //
    }
}