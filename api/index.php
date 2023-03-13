<?php
include_once "kamenrider.php";
header('Content-Type: application/json');
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

$secret_key = "KamenriderX";
$payload = array(
    'iss' => 'localhost',
    'aud' => 'localhost',
    'iat' => 1356999524,
    'data'=> [
        'id'=>23,
        'Name'=>'Kabuto'
    ]
);
$jwt = JWT::encode($payload, $secret_key,'HS256');
$datajson = ["status"=>1,"Token"=>$jwt];
echo json_encode($datajson);

$kamen = new dbkamen();

$datx = $kamen->getkamenriderlist();
echo '<pre>';
print_r($datx);
echo '</pre>';

?>
