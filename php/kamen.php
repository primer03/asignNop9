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
            $result = $this->pdo->query('SELECT kamen_id,kamen_name,kamen_datestart,kamen_datesend,kamen_img,kamen_logo,kamen_wallpaper,era_name,kamen_ep FROM tbl_kamenrider km,tbl_era era WHERE km.kamen_era = era.era_id;');
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

        public function getera(){
            $sql = "SELECT *FROM tbl_era";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $dataera = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $dataera;
        }

        public function updatekamen($datarray){
            $sql = "UPDATE tbl_kamenrider SET kamen_name = :kamen_name,kamen_datestart = :kamen_datestart,kamen_datesend = :kamen_datesend,kamen_logo = :kamen_logo,kamen_img = :kamen_img,kamen_wallpaper = :kamen_wallpaper,kamen_era = :kamen_era,kamen_ep = :kamen_ep WHERE kamen_id = :kamen_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($datarray);
            return 1;
        }

        public function updateera($datarray){
            $sql = "UPDATE tbl_era SET era_name = :era_name,era_description = :era_description,era_img = :era_img WHERE era_id  = :era_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($datarray);
            return 1;
        }

        public function deletekamen($id){
            $sql = "DELETE FROM tbl_kamenrider WHERE kamen_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1,$id);
            $stmt->execute();
            return 1;
        }

        public function deleteera($id){
            $sql = "DELETE FROM tbl_era WHERE era_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1,$id);
            $stmt->execute();
            return 1;
        }

        public function addkamen($datarray){
            if($this->checkname($datarray[':kamen_name'])){
                $sql = "INSERT INTO tbl_kamenrider (kamen_name,kamen_datestart,kamen_datesend,kamen_logo,kamen_img,kamen_wallpaper,kamen_era,kamen_ep) VALUE (:kamen_name,:kamen_datestart,:kamen_datesend,:kamen_logo,:kamen_img,:kamen_wallpaper,:kamen_era,:kamen_ep)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($datarray);
                return 1;
            }else{
                return 0;
            }
        }

        public function checkeraname($eraname){
            $sql = "SELECT *FROM tbl_era WHERE era_name = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1,$eraname);
            $stmt->execute();
            $row = $stmt->rowCount();
            if($row > 0){
                return false;
            }else{
                return true;
            }

        }

        public function addera($datarray){
            if($this->checkeraname($datarray[':era_name'])){
                $sql = "INSERT INTO tbl_era (era_name,era_description,era_img) VALUE (:era_name,:era_description,:era_img)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($datarray);
                return 1;
            }else{
                return 0;
            }
        }

        public function getdataindex(){
            $arrdata = [];
            $arrdata["datakamen"] = $this->getkamendata();
            $arrdata["dataera"] = $this->geteradata();
            return $arrdata;
        }

        private function getkamendata(){
            $result = $this->pdo->query('SELECT kamen_id,kamen_name,kamen_datestart,kamen_datesend,kamen_img,kamen_logo,kamen_wallpaper,era_name,kamen_ep FROM tbl_kamenrider km,tbl_era era WHERE km.kamen_era = era.era_id;');
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        private function geteradata(){
            $result = $this->pdo->query('SELECT *FROM tbl_era');
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
    }
?>