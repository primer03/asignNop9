<?php
    include_once 'kamenrider.php';
    require_once '../vendor/autoload.php';
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;
    $kamen = new dbkamen();
    $secret_key = "KamenriderX";
    $headers = apache_request_headers();
    $auth_header = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($auth_header !== null) {
        $auth_parts = explode(' ', $auth_header);
        if (count($auth_parts) === 2 && $auth_parts[0] === 'Bearer') {
            $bearer_token = $auth_parts[1];
            // header('Content-Type: application/json');
            $path = $_SERVER['PATH_INFO'] ?? '/';
            $backpath = $path;
            $path = substr($path,1,strlen($path));
            $patjarr = explode('/',$path);
            $Cpath = $patjarr[0];
           try{
            $datadecode = JWT::decode($bearer_token,new Key($secret_key,'HS256'));
            $decoded_array = (array) $datadecode;
            if($Cpath == 'kamen' && $method == 'POST'){
                $da = $kamen->getkamenrider();
                header("Content-Type:application/json");
                echo json_encode($da);
            }else if($Cpath == 'kamen' && $method == 'GET'){
                if(isset($patjarr[1]) != null && intval($patjarr[1]) != 0){
                    $daxw = $kamen->getkamenriderById(intval($patjarr[1]));
                    header("Content-Type:application/json");
                    echo json_encode($daxw);
                }else{
                    echo json_encode(["messge"=>'ID not found']);
                }  
            }else if($Cpath == 'charector' && $method == 'POST'){
                $arrcha = [["kamenridername"=>"Kamen Rider Gaimu","charectorname"=>["HEE","YAI"],"charectorimg"=>["https://i.imgur.com/Xk1p094.png","https://i.imgur.com/iWq0zKt.png"]]];
                header("Content-Type:application/json");
                echo json_encode($arrcha);
            }else if($Cpath == 'kamenname' && $method == 'POST'){
                $datx = $kamen->getkamenriderlist();
                header("Content-Type:application/json");
                echo json_encode($datx);
                
            }else if($Cpath == 'kamenchatector' && $method == 'POST'){
                $datachar = $kamen->getcharectorall();
                header("Content-Type:application/json");
                echo json_encode($datachar);
                
            }else if($Cpath == 'kamenchatectorImg' && $method == 'POST'){
                $datacharimg = $kamen->getcharectorImg();
                header("Content-Type:application/json");
                echo json_encode($datacharimg);
            }else if($Cpath == 'kamenAllchatectorById' && $method == 'GET'){
                if(isset($patjarr[1]) != null && intval($patjarr[1]) != 0){
                    $datacharID = $kamen->getcharectorById(intval($patjarr[1]));
                    header("Content-Type:application/json");
                    echo json_encode($datacharID);
                }else{
                    echo json_encode(["messge"=>'ID not found']);
                }
            }
           }catch(Exception $e){
            echo json_encode(["status"=>0,"message"=>$e->getMessage()]);
           }
        }
    }
?>