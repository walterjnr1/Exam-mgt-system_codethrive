<?php 
session_start();
error_reporting(1);
include('../database/connect.php'); 
include('../database/connect2.php'); 

//set time
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

// Define the current month and year
$current_month = date('m');
$current_year = date('Y');

//website data
$sitename = 'Online Tourism Booking System';
$logo ='uploadImage/Logo/logo.png';
$phone ='08067361023';
$secretkey='sk_test_47baa9aaab29e730ccc5d25c1f00761454fc58e4';
$publickey='pk_test_9180e4cbc4f6da45138bf24d6e5a4fce84439c58';


//fetch admin data
$username = $_SESSION["login_username"];
$stmt = $dbh->query("SELECT * FROM tbladmin where username='$username'");
$row2 = $stmt->fetch();
$fullname=$row2['fullname'];  
$photo=$row2['photo'];
$email=$row2['email'];
$password=$row2['password'];

?>