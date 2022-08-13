<?php 

session_start();
define('SITEURL','http://localhost/web-design-course-restaurant-master/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');
$conn1 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die('Error: ' . mysqli_error($myConnection));
$db_select =mysqli_select_db($conn1,DB_NAME) or die('Error: ' . mysqli_error($myConnection));

?>