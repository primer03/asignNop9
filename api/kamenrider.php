<?php
class dbkamen{
    protected $pdo = null;
    
    function __construct(){
        $this->connect();
    }

    private function connect(){
        $this->pdo = new PDO('mysql: host=localhost; dbname=kamennrider','root','');
    }

    public function getkamenriderlist(){
        $result = $this->pdo->query('SELECT kamen_id,kamen_name,kamen_datestart,kamen_datesend,kamen_img,kamen_logo,era_name,kamen_ep FROM tbl_kamenrider km,tbl_era era WHERE km.kamen_era = era.era_id;');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $key=>$value){
            foreach($value as $key1=>$datas){
             if($key1 == 'era_name'){
                 $data[$key]['kamen_era'] =  $data[$key]['era_name'];
                 unset($data[$key]['era_name']);
             }
            }
         }
        return $data;
    }

    

    public function getcharectorall(){
        $result = $this->pdo->query('SELECT `char_id`,`char_kamen_id`,kamen_name as kamenRiderSeries,`char_name`,`char_height`,`char_weight`,`char_eyesight`,`char_hearing`,`char_enemysensing`,`char_PunchingPower`,`char_GrippingPower`,`char_KickingPower`,`char_MaximumJumpHeight`,`char_MaximumJumpDistance`,`char_MaximumRunningSpeed`,`char_MaximumSwimmingSpeed`,`char_img` FROM tbl_charector c , tbl_kamenrider k WHERE c.char_kamen_id=k.kamen_id');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getcharectorById($id){
       $sql = "SELECT `char_id`,`char_kamen_id`,kamen_name as kamenRiderSeries,`char_name`,`char_height`,`char_weight`,`char_eyesight`,`char_hearing`,`char_enemysensing`,`char_PunchingPower`,`char_GrippingPower`,`char_KickingPower`,`char_MaximumJumpHeight`,`char_MaximumJumpDistance`,`char_MaximumRunningSpeed`,`char_MaximumSwimmingSpeed`,`char_img` FROM tbl_charector c , tbl_kamenrider k WHERE c.char_kamen_id=k.kamen_id and k.kamen_id = ?";
       $stmt = $this->pdo->prepare($sql);
       $stmt->bindParam(1,$id);
       $stmt->execute();
       $row = $stmt->rowCount();
       $datax = $stmt->fetchAll(PDO::FETCH_ASSOC);
       if($row > 0){
        return ["kamendatacharec"=>$datax];
       }else{
        return ["mesdage"=>'error'];
       }
    }

    private function getcharectordataById($id){
        $sql = "SELECT `char_id`,`char_kamen_id`,kamen_name as kamenRiderSeries,`char_name`,`char_height`,`char_weight`,`char_eyesight`,`char_hearing`,`char_enemysensing`,`char_PunchingPower`,`char_GrippingPower`,`char_KickingPower`,`char_MaximumJumpHeight`,`char_MaximumJumpDistance`,`char_MaximumRunningSpeed`,`char_MaximumSwimmingSpeed`,`char_img` FROM tbl_charector c , tbl_kamenrider k WHERE c.char_kamen_id=k.kamen_id and k.kamen_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $row = $stmt->rowCount();
        $datax = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($row > 0){
         return $datax;
        }else{
         return ["mesdage"=>'error'];
        }
     }

    public function getlastkamenrider(){
        $result = $this->pdo->query('SELECT kamen_id,kamen_name,kamen_datestart,kamen_datesend,kamen_img,kamen_logo,era_name,kamen_ep FROM tbl_kamenrider km,tbl_era era WHERE km.kamen_era = era.era_id ORDER BY era.era_id DESC, km.kamen_id DESC LIMIT 1;');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $row = $result->rowCount();
        if($row > 0){
            foreach($data as $key=>$value){
                foreach($value as $key1=>$datas){
                 if($key1 == 'era_name'){
                     $data[$key]['kamen_era'] =  $data[$key]['era_name'];
                     unset($data[$key]['era_name']);
                 }
                }
             }
             return $data;
        }else{
            return ["message"=>'error'];
        }
    }
    

    public function getkamenrider(){
        $result = $this->pdo->query('SELECT kamen_id,kamen_name,kamen_datestart,kamen_datesend,kamen_img,kamen_logo,era_name,kamen_ep FROM tbl_kamenrider km,tbl_era era WHERE km.kamen_era = era.era_id;');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $row = $result->rowCount();
        if($row > 0){
            foreach($data as $key=>$value){
                foreach($value as $key1=>$datas){
                 if($key1 == 'era_name'){
                     $data[$key]['kamen_era'] =  $data[$key]['era_name'];
                     unset($data[$key]['era_name']);
                 }
                }
             }
            $key = array_keys($data[0]);
            $arr = [];
            foreach($data as $keys=>$value){
                foreach($key as $va){
                    $arr[$keys]["kamendata"][$va] = $data[$keys][$va];
                }
                $arr[$keys]["kamendatacharec"] = $this->getcharectordataById($data[$keys]["kamen_id"]);
            }
            return  $arr;
        }else{
            return ["message"=>'error'];
        }
    }

    public function getkamenriderById($id){
        $sql = "SELECT kamen_id,kamen_name,kamen_datestart,kamen_datesend,kamen_img,kamen_logo,era_name,kamen_ep FROM tbl_kamenrider km,tbl_era era WHERE km.kamen_era = era.era_id and km.kamen_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();
        if($row > 0){
            foreach($data as $key=>$value){
                foreach($value as $key1=>$datas){
                 if($key1 == 'era_name'){
                     $data[$key]['kamen_era'] =  $data[$key]['era_name'];
                     unset($data[$key]['era_name']);
                 }
                }
             }
            $key = array_keys($data[0]);
            $arr = [];
            foreach($data as $keys=>$value){
                foreach($key as $va){
                    $arr["kamenByid"]["kamendata"][$va] = $data[$keys][$va];
                }
                $arr["kamenByid"]["kamendatacharec"] = $this->getcharectordataById($id);
            }
            return  $arr;
        }else{
            return ["message"=>'error'];
        }
    }

    public function getfirsterakamenrider(){
        $result = $this->pdo->query('SELECT kamen_id,kamen_name,kamen_datestart,kamen_datesend,kamen_img,kamen_logo,era_name,kamen_ep FROM tbl_kamenrider km,tbl_era era WHERE km.kamen_era = era.era_id and km.kamen_first = "YES" ;');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $row = $result->rowCount();
        if($row > 0){
            foreach($data as $key=>$value){
                foreach($value as $key1=>$datas){
                 if($key1 == 'era_name'){
                     $data[$key]['kamen_era'] =  $data[$key]['era_name'];
                     unset($data[$key]['era_name']);
                 }
                }
             }
             return $data;
        }else{
            return ["message"=>'error'];
        }
    }

    public function geteradata(){
        $result = $this->pdo->query('SELECT *FROM tbl_era');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $row = $result->rowCount();
        if($row > 0){
             return $data;
        }else{
            return ["message"=>'error'];
        }
    }

    public function getcharectorImg(){
        $result = $this->pdo->query('SELECT char_name,`char_img` FROM tbl_charector c , tbl_kamenrider k WHERE c.char_kamen_id=k.kamen_id ORDER BY k.kamen_id ASC');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $dataimg = [];
        $num = 0;
        return ["dataimg"=>$data];
    }
}
