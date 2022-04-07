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
    <a class="navbar-brand" href="index.php">VotingHub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item active ms-3">
          <a class="nav-link" href="displayVotes.php">View All Group</a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div<div style="position: relative;" class="container my-5">
    <h2><strong>Votes Till Now</strong></h2>
    <div class="table-responsive">
      <table class="table table-hover table-striped">
        <thead class="bg-warning">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Leader Name</th>
            <th>Total Votes Count</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $url = "http://localhost/wp2/votingHub/api/getGrp.php";
            $client = curl_init($url);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            $result = json_decode($response, true);
            $data = $result["data"];
            if($data != NULL){
              foreach($data as $row){
                echo '
                  <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['leader'].'</td>
                    <td>'.$row['votes'].'</td>
                  </tr>
                ';
              }
            } else {
              echo  "<h2>{$result['response_desc']}</h2>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>