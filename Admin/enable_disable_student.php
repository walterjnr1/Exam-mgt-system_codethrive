<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

	 // for Block student
if(isset($_GET['did']))
{
$did=intval($_GET['did']);

mysqli_query($conn,"update students set status='0' where id='$did'");
header("location: student_record");
}

// for unBlock student
if(isset($_GET['eid']))
{
$eid=intval($_GET['eid']);

mysqli_query($conn,"update students set status='1' where id='$eid'");
header("location: student_record");
}

?>
