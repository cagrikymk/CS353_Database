<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'cs353');
define('DB_USER','mehmet.kaymak');
define('DB_PASSWORD','235625');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect: " . mysql_error());
?>
