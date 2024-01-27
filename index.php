<?php

require "apps\Database\Connection.php";
require "apps\Mail\Connection.php";

use apps\Database\ConnectionDB;
use apps\Mail\ConnectionMail;


ConnectionDB::get_connection();
$test = ConnectionMail::get_connection()->get_messages();


//print_r($test);

