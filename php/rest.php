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
                    $datarr = [":kamen_id"=>$_POST['kamen_id'],":kamen_name"=>$_POST['kamen_name'],":kamen_datestart"=>$_POST['kamen_datestart'],":kamen_datesend"=>$_POST['kamen_datesend'],":kamen_logo"=>basename($_FILES['kamen_logo']['name']),":kamen_img"=>basename($_FILES['kamen_img']['name']),":kamen_era"=>$_POST['kamen_era'],":kamen_ep"=>$_POST['kamen_ep']];
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
       }else if(isset($_POST['kamen_namexd'])){
            $imgpalogo = explode(".", $_FILES['kamen_logoxd']['name']);
            $imgpaimg = explode(".", $_FILES['kamen_imgxd']['name']);
            $randlogo = rand();
            $randimg = rand();
            $randstringlogo = base_convert($randlogo,10,36);
            $randstringimg = base_convert($randimg,10,36);
            $_FILES['kamen_logoxd']['name'] = $randstringlogo.".".$imgpalogo[1];
            $_FILES['kamen_imgxd']['name'] = $randstringimg.".".$imgpaimg[1];
            $dirlogo = "../img/logoseries/";
            $dirimg = "../img/logorider/";
            $fillnamelogo = $dirlogo.basename($_FILES['kamen_logoxd']['name']);
            $fillnameimg = $dirimg.basename($_FILES['kamen_imgxd']['name']);
            if(move_uploaded_file($_FILES['kamen_imgxd']['tmp_name'], $fillnameimg) && move_uploaded_file($_FILES['kamen_logoxd']['tmp_name'], $fillnamelogo)){
                $datarrX = [":kamen_name"=>$_POST['kamen_namexd'],":kamen_datestart"=>$_POST['kamen_datestartxd'],":kamen_datesend"=>$_POST['kamen_datesendxd'],":kamen_logo"=>basename($_FILES['kamen_logoxd']['name']),":kamen_img"=>basename($_FILES['kamen_imgxd']['name']),":kamen_era"=>$_POST['kamen_eraxd'],":kamen_ep"=>$_POST['kamen_epxd']] ;
                $dataX = $kamen->addkamen($datarrX);
                if($dataX > 0){
                    echo json_encode(["status"=>1,"message"=>"success"]);
                }else{
                    echo json_encode(["status"=>0,"message"=>"error"]);
                }
            }
        }else if(isset($_POST['era_id'])){
            // echo $_POST['era_id'];
            if(isset($_FILES['era_img']) != null){
                $imgpa = explode(".", $_FILES['era_img']['name']);
                $rand = rand();
                $randstring = base_convert($rand,10,36);
                $_FILES['era_img']['name'] = $randstring.".".$imgpa[1];
                $dir = "../img/logoera/";
                $fillname = $dir.basename($_FILES['era_img']['name']);
                if(move_uploaded_file($_FILES['era_img']['tmp_name'], $fillname)){
                    $datarr = [":era_id"=>$_POST['era_id'],":era_name"=>$_POST['era_name'],":era_description"=>$_POST['era_description'],":era_img"=>basename($_FILES['era_img']['name'])];
                    $data = $kamen->updateera($datarr);
                    if($datarr > 0){
                        echo json_encode(["status"=>1,"message"=>"success"]);
                    }else{
                        echo json_encode(["status"=>0,"message"=>"error"]);
                    }
                }else{
                    echo "NOXD";
                }
            }else{
                $datarr = [":era_id"=>$_POST['era_id'],":era_name"=>$_POST['era_name'],":era_description"=>$_POST['era_description'],":era_img"=>$_POST['era_img']];
                    $data = $kamen->updateera($datarr);
                    if($data > 0){
                        echo json_encode(["status"=>1,"message"=>"success"]);
                    }else{
                        echo json_encode(["status"=>0,"message"=>"error"]);
                    }
            }
        }else if(isset($_POST['era_namexd'])){
                $imgpa = explode(".", $_FILES['era_imgxd']['name']);
                $rand = rand();
                $randstring = base_convert($rand,10,36);
                $_FILES['era_imgxd']['name'] = $randstring.".".$imgpa[1];
                $dir = "../img/logoera/";
                $fillname = $dir.basename($_FILES['era_imgxd']['name']);
                if(move_uploaded_file($_FILES['era_imgxd']['tmp_name'], $fillname)){
                    $datarrx = [":era_name"=>$_POST['era_namexd'],":era_description"=>$_POST['era_descriptionxd'],":era_img"=>basename($_FILES['era_imgxd']['name'])];
                    $datae = $kamen->addera($datarrx);
                    if($datae > 0){
                        echo json_encode(["status"=>1,"message"=>"success"]);
                    }else{
                        echo json_encode(["status"=>0,"message"=>"error"]);
                    }
                    // echo json_encode($datarr);
                }else{
                    echo "NOXD";
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
        }else if(isset($_GET['kamen_xd'])){
            $dats = $kamen->deletekamen($_GET['kamen_xd']);
            if($dats > 0){
                echo json_encode(["status"=>1,"message"=>"success"]);
            }else{
                echo json_encode(["status"=>0,"message"=>"error"]);
            }
        }else if(isset($_GET['dataera'])){
            $datera = $kamen->getera();
            echo json_encode($datera);
        }else if(isset($_GET['era_xd'])){
            $dats = $kamen->deleteera($_GET['era_xd']);
            if($dats > 0){
                echo json_encode(["status"=>1,"message"=>"success"]);
            }else{
                echo json_encode(["status"=>0,"message"=>"error"]);
            }
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