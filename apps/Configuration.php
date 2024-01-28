<?php

namespace apps;

class Configuration
{
    protected $config = null;

    protected function get_ini_config()
    {
        if ($this->config !== null){
            echo "[LOG] Return config.ini.\n";
            return $this->config;
        }

        echo "[LOG] Reading config.ini.\n";
        $this->config = parse_ini_file("config/config.ini");

        if (is_array($this->config)){
            return $this->config;

        }

        echo "[LOG] The file could not be read config.ini.";
        die();
    }

    public static function get_connection()
    {
        //
    }
}