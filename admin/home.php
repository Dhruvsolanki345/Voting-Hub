<?php
 include '../helper.php'; 
 include '../login.php'; 
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>VotingHub</title>
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="home.php">VotingHub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 fs-5">
        <li class="nav-item px-2">
          <a class="nav-link active" href="#">Users</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link" href="addUser.php">Add User</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link" href="addgrp.php">Add Group</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link" href="displaygrp.php">Groups</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item active">
          <a class="btn btn-outline-danger my-2 my-sm-0" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div style="position: relative;" class="container my-5">
    <h2><strong>Users Details</strong></h2>
    <a href="addUser.php" style="position: absolute; right: 0; top: 0px;" class="btn btn-primary">Add User</a>
    <div class="table-responsive">
      <table class="table table-hover table-striped">
        <thead class="bg-warning">
          <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "select * from users";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                echo '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['uname'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['type'].'</td>
                        <td>
                          <a class="btn btn-info" href="addUser.php?uid='.$row['id'].'">Update User</a>
                          <a class="btn btn-danger ms-5" href="helperDelUser.php?uid='.$row['id'].'">Delete User</a>
                        </td>
                    </tr>';
              } 
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>
<?php 
$conn->close();
?>