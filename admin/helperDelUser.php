<?php
  include "../helper.php";

  $sql = "DELETE FROM users WHERE id={$_GET['uid']}";

  if ($conn->query($sql) === TRUE) {
    header('Location: home.php');
  } else {
    header('Location: addUser.php?alert=User could not be deleted&danger=1');
  }

  $conn->close();

  exit();
?>