<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

	 // for Block admin
if(isset($_GET['did']))
{
$did=intval($_GET['did']);

mysqli_query($conn,"update users set status='0' where id='$did'");
header("location: user_record");
}

// Get student name by ID
$studentId = $_GET['id'];
$studentName = mysqli_query($conn, "SELECT name FROM students WHERE id = '$studentId'");
$studentName = mysqli_fetch_assoc($studentName);

// Return student name
echo $studentName['name'];
?>