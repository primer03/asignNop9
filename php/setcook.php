<?php
    $data = 'This is the data to be encrypted';
    $method = 'aes-256-cbc';
    $key = 'KamenriderXDXD';
    $options = 0;
    $iv = openssl_random_pseudo_bytes(16);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ecname = encrypt($_POST['Username'],$key);
        setcookie("username", $ecname, time()+(1*60*60), "/");
        echo json_encode(["status"=>1,"message"=>"log in success"]);
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