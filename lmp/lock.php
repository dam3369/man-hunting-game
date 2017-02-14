<?php
session_start();

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if(!$_SESSION) {header("Location: http://cal.12.gy/lmp/signin.php");}
?>