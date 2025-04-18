<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

// Update student class
$studentId = $_POST['id'];
$classId = $_POST['class_id'];
mysqli_query($conn, "UPDATE students SET class_id = '$classId' WHERE id = '$studentId'");

// Return success message
echo 'Student class updated successfully!';
?>