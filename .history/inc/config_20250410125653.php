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

//school data
$school_id = $_SESSION["login_school_id"];
$stmt = $dbh->query("SELECT * FROM schools where id='$school_id'");
$row_school = $stmt->fetch();

//fetch user data
$username = $_SESSION["login_email"];
$stmt = $dbh->query("SELECT * FROM tbladmin where username='$username'");
$row2 = $stmt->fetch();
$fullname=$row2['fullname'];  
$photo=$row2['photo'];
$email=$row2['email'];
$password=$row2['password'];

?>