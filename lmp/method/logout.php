<?php
require './../lock.php';
require './connect.php';

ini_set('display_errors', 1); 

// On écrase le tableau de session
$_SESSION = array();

// On détruit la session
session_destroy();
header($after_logout);
?>