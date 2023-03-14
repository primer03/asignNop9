<?php 
    include_once "user.php";
    $user = new user();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       $data = json_decode(file_get_contents("php://input"),true);
       $data[":u_password"] = password_hash($data[":u_password"], PASSWORD_DEFAULT);
       $call = $user->adduser($data);
       if($call == 1){
        echo json_encode(["message"=>"success"]);
       }else{
        echo json_encode(["message"=>"fail"]);
       }
    }
?>