<?php 
//common session for all
session_start();
//create constant to stor enon repeating values
define('SITEURL', 'http://localhost/Food-odering-site/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-odering-site');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection 
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //databsae selection
?>