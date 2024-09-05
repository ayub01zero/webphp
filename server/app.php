<?php 
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');
require_once('connection.php');
require_once('helpers.php');
execute("set global max_allowed_packet=1000000000;");
