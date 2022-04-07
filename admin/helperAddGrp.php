<?php
  include "../helper.php";

  $sql = "INSERT INTO grp (name, leader, votes) VALUES ('{$_POST['name']}', '{$_POST['leader']}' , 0 )";

  if ($conn->query($sql) === TRUE) {
    header('Location: addgrp.php?alert=Group added successfully');
  } else {
    header('Location: addgrp.php?alert=Group could not be added&danger=1');
  }

  $conn->close();
  
  exit();
?>