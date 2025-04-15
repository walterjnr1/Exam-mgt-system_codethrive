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

$app_name = 'Grade Pulse';
$app_logo = 'uploadImage/Logo/gradeplus.jpeg';
$app_email = 'support@gradepulse.com';
$school_code = $_SESSION["school_code"];

//school data
$school_id = $_SESSION["school_id"];

$stmt = $dbh->query("SELECT * FROM schools where id='$school_id'");
$row_school = $stmt->fetch();

//fetch teacher data
$user_id = $_SESSION["user_id"];
$stmt = $dbh->query("SELECT * FROM users where user_id='$user_id' and school_id='$school_id' and role ='Teacher' or role ='Admin'");
$row_user = $stmt->fetch();

//fetch Admin data
//$stmt = $dbh->query("SELECT * FROM users where school_id='$school_id' and role ='Admin'");
//$row_admin = $stmt->fetch();

//no of students
$stmt = $dbh->query("SELECT COUNT(*) as total FROM students where school_id='$school_id'");
$no_students = $stmt->fetch();

//no of teacher
$stmt = $dbh->query("SELECT COUNT(*) as total FROM users where school_id='$school_id' and role ='Teacher'");
$no_teachers = $stmt->fetch();

//no of users
$stmt = $dbh->query("SELECT COUNT(*) as total FROM users where school_id='$school_id' and role ='Admin'");
$no_users = $stmt->fetch();

//no of class
$stmt = $dbh->query("SELECT COUNT(*) as total FROM classes WHERE school_id='$school_id'");
$no_classes = $stmt->fetch();

//no of subject
$stmt = $dbh->query("SELECT COUNT(*) as total FROM subjects WHERE school_id='$school_id
'");
$no_subject = $stmt->fetch();


?>