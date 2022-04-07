<?php
include "helper.php";

$to = $_GET['to'];
$subject='Voting count till now';
$message = '
<html>
<head>
  <title>Voting count till now</title>
  <style>
    table, th, td {
      border: 2px solid red;
      border-collapse: collapse;
    }
  </style>
</head>
<body>
  <p>Voting count till now</p>
  <table>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Leader Name</th>
      <th>Total Votes Count</th>
    </tr>';

$sql = "select * from grp";
$result = $conn->query($sql);
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $message .= '
      <tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['leader'].'</td>
        <td>'.$row['votes'].'</td>
      </tr>
    ';
  }
}
$message .= '
  </table>
</body>
</html>
';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


if(!mail($to, $subject, $message, $headers))
    echo '<script>alert("Error while sending mail")</script>';

$conn->close();
header('location: logout.php');
exit();
?>