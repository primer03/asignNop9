<?php
    include_once "user.php";
    session_start();
    $data = 'This is the data to be encrypted';
    $method = 'aes-256-cbc';
    $key = 'KamenriderXDXD';
    $options = 0;
    $iv = openssl_random_pseudo_bytes(16);
    $user = new user();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datx = $user->selectDatauser($_POST['Username']);
        if($datx[0]['status'] == 'success'){
            if( password_verify($_POST['password'], $datx[0]['u_password'])){
                $ecname = encrypt($_POST['Username'],$key);
                setcookie("username", $ecname, time()+(1*60*60), "/");
                echo json_encode(["status"=>1,"message"=>"log in success"]);
            }else{
                echo json_encode(["status"=>0,"message"=>"log in fail"]);
            }
        }else{
            echo json_encode(["status"=>0,"message"=>"log in fail"]);
        }
        // echo json_encode($datx["u_password"]);
        // echo json_encode(["s"=>1]);
        // $ecname = encrypt($_POST['Username'],$key);
        // setcookie("username", $ecname, time()+(1*60*60), "/");
        // echo json_encode(["status"=>1,"message"=>"log in success"]);

    }else if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $_SESSION["username"] =  decrypt($_GET['user'], $key);
        // echo $_GET['user'];
        // setcookie("XD", $_GET['user'], time()+(1*60*60), "/");

    }

    function encrypt($plaintext, $key) {
        $iv = openssl_random_pseudo_bytes(16);
        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $ciphertext);
    }
    
    function decrypt($ciphertext, $key) {
        $ciphertext = base64_decode($ciphertext);
        $iv = substr($ciphertext, 0, openssl_cipher_iv_length('aes-256-cbc'));
        $ciphertext = substr($ciphertext, openssl_cipher_iv_length('aes-256-cbc'));
        $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }

?>