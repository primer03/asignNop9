<?php
    class kamen{
        protected $pdo = null;
    
        function __construct(){
            $this->connect();
        }
    
        private function connect(){
            $this->pdo = new PDO('mysql: host=localhost; dbname=kamennrider','root','');
        }

        public function getdataseries(){
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
                return  $data;
            }else{
                return ["message"=>'error'];
            }
        }

        public function checkname($namekamen){
            $sql = "SELECT *FROM tbl_kamenrider WHERE kamen_name = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1,$namekamen);
            $stmt->execute();
            $row = $stmt->rowCount();
            if($row > 0){
                return false;
            }else{
                return true;
            }

        }

        public function updatekamen($datarray){
            $sql = "UPDATE tbl_kamenrider SET kamen_name = :kamen_name,kamen_datestart = :kamen_datestart,kamen_datesend = :kamen_datesend,kamen_logo = :kamen_logo,kamen_img = :kamen_img,kamen_era = :kamen_era,kamen_ep = :kamen_ep WHERE kamen_id = :kamen_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($datarray);
            return 1;
        }
    }
?>