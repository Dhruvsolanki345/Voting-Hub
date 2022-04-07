<?php
session_start();

if ($_SESSION['loginMethod'] == "username") {
  $sql = "SELECT * FROM users where uname = '{$_SESSION['username']}' and pass = '{$_SESSION['pass']}' and type='{$_SESSION['type']}'";
} else {
  $sql = "SELECT * FROM users where email = '{$_SESSION['email']}' and pass = '{$_SESSION['pass']}' and type='{$_SESSION['type']}'";
}

$result = $conn->query($sql);

if($result->num_rows == 0){
  header("Location: http://localhost/wp2/votingHub?alert=No Account Present With This User Details");
  exit();
}

$row = $result->fetch_assoc();
$_SESSION['uid'] = $row['id'];
$_SESSION['email'] = $row['email'];
$_SESSION['username'] = $row['uname'];

?>