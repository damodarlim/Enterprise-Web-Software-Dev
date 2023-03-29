<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "web_based_role";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>