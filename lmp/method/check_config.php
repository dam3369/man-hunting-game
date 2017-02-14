<?php
ini_set('display_errors', 1); 
require('./connect.php');
if(file_exists(substr($ep0, 1)."index.php") || file_exists(substr($ep0, 1)."index.html"))echo "home page ok <br />";else echo "home page not ok <br />";
if(file_exists(substr($ep1, 1)."index.php") || file_exists(substr($ep1, 1)."index.html"))echo "epreuve 1 ok <br />";else echo "epreuve 1 not ok <br />";
if(file_exists(substr($ep2, 1)."index.php") || file_exists(substr($ep2, 1)."index.html"))echo "epreuve 2 ok <br />";else echo "epreuve 2 not ok <br />";
if(file_exists(substr($ep3, 1)."index.php") || file_exists(substr($ep3, 1)."index.html"))echo "epreuve 3 ok <br />";else echo "epreuve 3 not ok <br />";
if(file_exists(substr($ep4, 1)."index.php") || file_exists(substr($ep4, 1)."index.html"))echo "epreuve 4 ok <br />";else echo "epreuve 4 not ok <br />";
if(file_exists(substr($ep5, 1)."index.php") || file_exists(substr($ep5, 1)."index.html"))echo "epreuve 5 ok <br />";else echo "epreuve 5 not ok <br />";
if(file_exists(substr($ep6, 1)."index.php") || file_exists(substr($ep6, 1)."index.html"))echo "epreuve 6 ok <br />";else echo "epreuve 6 not ok <br />";
if(file_exists(substr($after_login, 1)))echo "after login ok <br />";else echo "after login not ok <br />";
if(file_exists(substr($after_login_admin, 1)))echo "after login admin ok <br />";else echo "after login admin not ok <br />";
if(file_exists(substr($after_create, 1)))echo "after create ok <br />";else echo "after create not ok <br />";
if(file_exists(substr($after_logout, 1)))echo "after logout ok <br />";else echo "after logout not ok <br />";
if($deport_config)echo "Deport config true<br />";else echo "Deport config false<br />";

?>