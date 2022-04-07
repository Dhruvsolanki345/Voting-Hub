<?php
$servername = "localhost";
$port = "3303";
$username = "root";
$password = "";
$dbName = "votinghub";

$conn = new mysqli($servername, $username, $password, $dbName, $port);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>