<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../user_login");
}

$id= $_GET['id'];
$sql = "DELETE FROM subjects WHERE id=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

header("Location: subject_record");
 ?>
