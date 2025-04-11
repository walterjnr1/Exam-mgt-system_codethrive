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
$email = $_SESSION["login_email"];
$stmt = $dbh->query("SELECT * FROM users where email='$email'");
$row_user = $stmt->fetch();

//count
//no of students
$stmt = $dbh->query("SELECT COUNT(*) as total FROM students where school_id='$school_id
'");
$no_students = $stmt->fetch();

//no of teachers
$stmt = $dbh->query("SELECT COUNT(*) as total FROM teachers WHERE school_id='$school_id
'");
$no_teachers = $stmt->fetch();

//no of class
$stmt = $dbh->query("SELECT COUNT(*) as total FROM classes WHERE school_id='$school_id

'");
?>