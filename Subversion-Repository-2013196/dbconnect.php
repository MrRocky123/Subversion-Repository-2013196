<?php 
$conn = mysqli_connect('localhost','root', '','database-xxxxxx');

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>