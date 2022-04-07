<?php
  include "../helper.php";

  $sql = "UPDATE users SET name = '{$_POST['name']}', uname = '{$_POST['username']}', email = '{$_POST['email']}', pass = '{$_POST['pass']}', type = '{$_POST['type']}' WHERE id = {$_POST['id']}";

  echo $sql;

  if ($conn->query($sql) === TRUE) {
    header('Location: home.php');
  } else {
    header('Location: addUser.php?alert=User could not be updated&danger=1');
  }

  $conn->close();

  exit();
?>