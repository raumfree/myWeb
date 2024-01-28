<?php

require "apps\Database\Connection.php";
require "apps\Mail\Connection.php";

use apps\Database\ConnectionDB;
use apps\Mail\ConnectionMail;


$database = ConnectionDB::get_connection();

// Таймер

$test = ConnectionMail::get_connection()->get_messages();
$database->query($test);



