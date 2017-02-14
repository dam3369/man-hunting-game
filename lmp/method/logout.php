<?php
require './../lock.php';
require './connect.php';

ini_set('display_errors', 1); ini_set('log_errors', 1); ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); error_reporting(E_ALL);

// On écrase le tableau de session
$_SESSION = array();

// On détruit la session
session_destroy();
header($after_logout);
?>