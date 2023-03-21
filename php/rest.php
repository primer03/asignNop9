<?php 
    include_once "user.php";
    include_once "kamen.php";
    $user = new user();
    $kamen = new kamen();
    $key = 'KamenriderXDXD';
    $options = 0;
    $iv = openssl_random_pseudo_bytes(16);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       if(isset($_POST['kamen_name'])){
            // $imgpa = explode(".", $_FILES['kamen_logo']['name']);
            // $rand = rand();
            // $randstring = base_convert($rand,10,36);
            // $_FILES['kamen_logo']['name'] = $randstring.".".$imgpa[1];
            // echo json_encode($_FILES['kamen_logo']);
            if(isset($_FILES['kamen_logo']) != null && isset($_FILES['kamen_img']) == null){
                $imgpa = explode(".", $_FILES['kamen_logo']['name']);
                $rand = rand();
                $randstring = base_convert($rand,10,36);
                $_FILES['kamen_logo']['name'] = $randstring.".".$imgpa[1];
                $dir = "../img/logoseries/";
                $fillname = $dir.basename($_FILES['kamen_logo']['name']);
                if(move_uploaded_file($_FILES['kamen_logo']['tmp_name'], $fillname)){
                    $datarr = [":kamen_id"=>$_POST['kamen_id'],":kamen_name"=>$_POST['kamen_name'],":kamen_datestart"=>$_POST['kamen_datestart'],":kamen_datesend"=>$_POST['kamen_datesend'],":kamen_logo"=>basename($_FILES['kamen_logo']['name']),":kamen_img"=>$_POST['kamen_img'],":kamen_era"=>$_POST['kamen_era'],":kamen_ep"=>$_POST['kamen_ep']] ;
                    $data = $kamen->updatekamen($datarr);
                    if($data > 0){
                        echo json_encode(["status"=>1,"message"=>"success"]);
                    }else{
                        echo json_encode(["status"=>0,"message"=>"error"]);
                    }
                }else{
                    echo "NOXD";
                }
            }else if(isset($_FILES['kamen_logo']) == null && isset($_FILES['kamen_img']) != null){
                $imgpa = explode(".", $_FILES['kamen_img']['name']);
                $rand = rand();
                $randstring = base_convert($rand,10,36);
                $_FILES['kamen_img']['name'] = $randstring.".".$imgpa[1];
                $dir = "../img/logorider/";
                $fillname = $dir.basename($_FILES['kamen_img']['name']);
                if(move_uploaded_file($_FILES['kamen_img']['tmp_name'], $fillname)){
                    $datarr = [":kamen_id"=>$_POST['kamen_id'],":kamen_name"=>$_POST['kamen_name'],":kamen_datestart"=>$_POST['kamen_datestart'],":kamen_datesend"=>$_POST['kamen_datesend'],":kamen_logo"=>$_POST['kamen_logo'],":kamen_img"=>basename($_FILES['kamen_img']['name']),":kamen_era"=>$_POST['kamen_era'],":kamen_ep"=>$_POST['kamen_ep']] ;
                    $data = $kamen->updatekamen($datarr);
                    if($data > 0){
                        echo json_encode(["status"=>1,"message"=>"success"]);
                    }else{
                        echo json_encode(["status"=>0,"message"=>"error"]);
                    }
                }else{
                    echo "NO";
                }
            }else if(isset($_FILES['kamen_logo']) != null && isset($_FILES['kamen_img']) != null){
                // echo json_encode($_FILES['kamen_logo']);
                // echo json_encode($_FILES['kamen_img']);
                $imgpalogo = explode(".", $_FILES['kamen_logo']['name']);
                $imgpaimg = explode(".", $_FILES['kamen_img']['name']);
                $randlogo = rand();
                $randimg = rand();
                $randstringlogo = base_convert($randlogo,10,36);
                $randstringimg = base_convert($randimg,10,36);
                $_FILES['kamen_logo']['name'] = $randstringlogo.".".$imgpalogo[1];
                $_FILES['kamen_img']['name'] = $randstringimg.".".$imgpaimg[1];
                $dirlogo = "../img/logoseries/";
                $dirimg = "../img/logorider/";
                $fillnamelogo = $dirlogo.basename($_FILES['kamen_logo']['name']);
                $fillnameimg = $dirimg.basename($_FILES['kamen_img']['name']);
                if(move_uploaded_file($_FILES['kamen_img']['tmp_name'], $fillnameimg) && move_uploaded_file($_FILES['kamen_logo']['tmp_name'], $fillnamelogo)){
                    $datarr = [":kamen_id"=>$_POST['kamen_id'],":kamen_name"=>$_POST['kamen_name'],":kamen_datestart"=>$_POST['kamen_datestart'],":kamen_datesend"=>$_POST['kamen_datesend'],":kamen_logo"=>basename($_FILES['kamen_logo']['name']),":kamen_img"=>basename($_FILES['kamen_img']['name']),":kamen_era"=>$_POST['kamen_era'],":kamen_ep"=>$_POST['kamen_ep']] ;
                    $data = $kamen->updatekamen($datarr);
                    if($data > 0){
                        echo json_encode(["status"=>1,"message"=>"success"]);
                    }else{
                        echo json_encode(["status"=>0,"message"=>"error"]);
                    }
                }else{
                    echo "NO";
                }
            }else{
                $datarr = [":kamen_id"=>$_POST['kamen_id'],":kamen_name"=>$_POST['kamen_name'],":kamen_datestart"=>$_POST['kamen_datestart'],":kamen_datesend"=>$_POST['kamen_datesend'],":kamen_logo"=>$_POST['kamen_logo'],":kamen_img"=>$_POST['kamen_img'],":kamen_era"=>$_POST['kamen_era'],":kamen_ep"=>$_POST['kamen_ep']] ;
                $data = $kamen->updatekamen($datarr);
                if($data > 0){
                    echo json_encode(["status"=>1,"message"=>"success"]);
                }else{
                    echo json_encode(["status"=>0,"message"=>"error"]);
                }
            }
       }else{
        $data = json_decode(file_get_contents("php://input"),true);
        $data[":u_password"] = password_hash($data[":u_password"], PASSWORD_DEFAULT);
        $call = $user->adduser($data);
        if($call == 1){
            echo json_encode(["message"=>"success"]);
        }else{
            echo json_encode(["message"=>"fail"]);
        }
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