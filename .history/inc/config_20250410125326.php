<?php 
session_start();
error_reporting(1);
include('../database/connect.php'); 
include('../database/connect2.php'); 

//set time
date_default_timezone_set('Africa/Accra');
$current_date = date('Y-m-d H:i:s');

// Define the current month and year
$current_month = date('m');
$current_year = date('Y');

//website data
$username = $_SESSION["login_username"];

$stmt = $dbh->query("SELECT * FROM tbladmin where username='$username'");
$row2 = $stmt->fetch();
$fullname=$row2['fullname'];  
$photo=$row2['photo'];
$email=$row2['email'];
$password=$row2['password'];


//fetch admin data
$username = $_SESSION["login_username"];
$stmt = $dbh->query("SELECT * FROM tbladmin where username='$username'");
$row2 = $stmt->fetch();
$fullname=$row2['fullname'];  
$photo=$row2['photo'];
$email=$row2['email'];
$password=$row2['password'];

?>