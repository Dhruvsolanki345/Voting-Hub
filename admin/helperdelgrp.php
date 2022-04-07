<?php
  include "../helper.php";

  $sql = "DELETE FROM grp WHERE id={$_GET['id']}";

  if ($conn->query($sql) === TRUE) {
    header('Location: displaygrp.php');
  } else {
    header('Location: addgrp.php?alert=Group could not be deleted&danger=1');
  }

  $conn->close();

  exit();
?>