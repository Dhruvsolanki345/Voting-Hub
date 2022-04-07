<?php 
    include "../helper.php";

    header("Content-Type:application/json");

    $sql = "select * from grp";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $res = [];
      while($row = $result->fetch_assoc()){
        array_push($res, $row);
      }
      response($res,200,"OK");
    } else {
      response(NULL,200,"No records found");
    }

    function response($data,$response_code,$response_desc){
        $response['data']=$data;
        $response['response_code']=$response_code;
        $response['response_desc']=$response_desc;
        $jsonresponse = json_encode($response);
        echo $jsonresponse;
    }

    $conn->close();
?>