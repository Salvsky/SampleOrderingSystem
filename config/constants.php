<?php
//Start Session
session_start();




// Create constants to store non repeating Values
define('SITEURL', 'http://localhost/SampleFoodOrdering/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food_ordering');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // Selecting Database

// if(mysqli_connect_error()){
//     echo ("Sayang boss, bawal kumunekta");
// }else{
//     echo ("yun oh! Pasok brad!");
// }


?>