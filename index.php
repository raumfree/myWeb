<?php

require "apps\Database\Connection.php";
require "apps\Mail\Connection.php";

use apps\Database\ConnectionDB;
use apps\Mail\ConnectionMail;


ConnectionDB::get_connection();
ConnectionMail::get_connection();


