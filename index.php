<?php

require "apps\Database\Connection.php";
require "apps\Mail\Connection.php";

use apps\Database\ConnectionDB;
use apps\Mail\ConnectionMail;


$database = ConnectionDB::get_connection();
$delay = 20;

// Таймер


while (true){

    $test = ConnectionMail::get_connection()->get_messages();
    $database->query($test);

    echo "\n[LOG] Set a timer for ". $delay . " seconds.\n\n";
    sleep($delay);

}







