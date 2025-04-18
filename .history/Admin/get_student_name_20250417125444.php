<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

// Get student name by ID
$studentId = $_GET['id'];
$studentName = mysqli_query($conn, "SELECT name FROM students WHERE id = '$studentId'");
$studentName = mysqli_fetch_assoc($studentName);

// Return student name
echo $studentName['name'];
?>