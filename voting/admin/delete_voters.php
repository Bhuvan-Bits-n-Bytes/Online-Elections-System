<?php
include('dbcon.php');
$voters_id=$_GET['voters_id'];
$conn->query("delete from voters where voters_id='$voters_id'") or die($conn->error);
header('location:voters.php');
?>
