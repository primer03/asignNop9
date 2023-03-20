<?php 
    include_once "user.php";
    include_once "kamen.php";
    $user = new user();
    $kamen = new kamen();
    $key = 'KamenriderXDXD';
    $options = 0;
    $iv = openssl_random_pseudo_bytes(16);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       $data = json_decode(file_get_contents("php://input"),true);
       $data[":u_password"] = password_hash($data[":u_password"], PASSWORD_DEFAULT);
       $call = $user->adduser($data);
       if($call == 1){
        echo json_encode(["message"=>"success"]);
       }else{
        echo json_encode(["message"=>"fail"]);
       }
    }else if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['user'])){
            $_SESSION["username"] =  decrypt($_GET['user'], $key);
            // echo decrypt($_GET['user'],$key);
            $datcx = $user->getuser(decrypt($_GET['user'],$key));
            echo json_encode($datcx);
        }else if(isset($_GET['dataseries'])){
            $datase = $kamen->getdataseries();
            echo json_encode($datase);
        }
    }

    function decrypt($ciphertext, $key) {
        $ciphertext = base64_decode($ciphertext);
        $iv = substr($ciphertext, 0, openssl_cipher_iv_length('aes-256-cbc'));
        $ciphertext = substr($ciphertext, openssl_cipher_iv_length('aes-256-cbc'));
        $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }
?>