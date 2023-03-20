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
    }
?>