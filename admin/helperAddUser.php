<?php
  include "../helper.php";

  $sql = "INSERT INTO users (name, uname, email, pass, type) VALUES ('{$_POST['name']}', '{$_POST['username']}', '{$_POST['email']}', '{$_POST['pass']}', '{$_POST['type']}')";

  if ($conn->query($sql) === TRUE) {
    header('Location: addUser.php?alert=User added successfully');
  } else {
    header('Location: addUser.php?alert=User could not be added&danger=1');
  }

  $conn->close();
  
  exit();
?>