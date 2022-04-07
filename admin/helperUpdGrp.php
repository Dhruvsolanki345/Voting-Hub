<?php
  include "../helper.php";

  $sql = "UPDATE grp SET name = '{$_POST['name']}', leader = '{$_POST['leader']}' WHERE id = {$_POST['id']}";

  echo $sql;

  if ($conn->query($sql) === TRUE) {
    header('Location: displaygrp.php');
  } else {
    header('Location: addgrp.php?alert=Group could not be updated&danger=1');
  }

  $conn->close();

  exit();
?>