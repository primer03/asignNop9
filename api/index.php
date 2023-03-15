<?php
include_once "kamenrider.php";
include_once "../php/user.php";
header('Content-Type: application/json');
require_once '../vendor/autoload.php';
$path = $_SERVER['PATH_INFO'] ?? '/';
$backpath = $path;
$path = substr($path,1,strlen($path));
$patjarr = explode('/',$path);
$Cpath = $patjarr[0];
$method = $_SERVER['REQUEST_METHOD'];
$user = new user();
use \Firebase\JWT\JWT;

if($Cpath == 'getToken' && $method == 'POST'){
    $secret_key = "KamenriderX";
    $payload = array(
        'iss' => 'localhost',
        'aud' => 'localhost',
        'iat' => 1356999524,
        'data'=> [
            'id'=>$_POST['id'],
            'Name'=>$_POST['username']
        ]
    );
    $jwt = JWT::encode($payload, $secret_key,'HS256');
    $datajson = ["status"=>1,"Token"=>$jwt];
    $c = $user->updatetoken($jwt,$_POST['id']);
    header("Content-Type:application/json");
    echo json_encode($datajson);
}

// $secret_key = "KamenriderX";
// $payload = array(
//     'iss' => 'localhost',
//     'aud' => 'localhost',
//     'iat' => 1356999524,
//     'data'=> [
//         'id'=>23,
//         'Name'=>'Kabuto'
//     ]
// );
// $jwt = JWT::encode($payload, $secret_key,'HS256');
// $datajson = ["status"=>1,"Token"=>$jwt];
// echo json_encode($datajson);

// $kamen = new dbkamen();

// $datx = $kamen->getkamenriderlist();
// echo '<pre>';
// print_r($datx);
// echo '</pre>';



?>
