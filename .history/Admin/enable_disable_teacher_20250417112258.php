<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

	 // for Block teachr
if(isset($_GET['did']))
{
$did=intval($_GET['did']);

mysqli_query($conn,"update users set status='0' id='$did'");
header("location: teacher_record");
}

// for unBlock teacher
if(isset($_GET['eid']))
{
$eid=intval($_GET['eid']);

mysqli_query($conn,"update users set status='1' where id='$eid'");
header("location: teacher_record");
}

?>
