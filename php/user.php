<?php
    class user{
        protected $pdo = null;
    
        function __construct(){
            $this->connect();
        }
    
        private function connect(){
            $this->pdo = new PDO('mysql: host=localhost; dbname=kamennrider','root','');
        }

        public function adduser($data){
           if(($this->checkusername($data[":u_username"]) == 0) && $this->checkemail($data[":u_email"]) == 0){
            $sql = "INSERT INTO tbl_user (u_username,u_email,u_password,u_favorite) VALUE (:u_username,:u_email,:u_password,:u_favorite)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            return 1;
           }else{
            return 0;
           }
        }

        public function checkusername($name){
            $sql = "SELECT *FROM tbl_user WHERE u_username = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1,$name);
            $stmt->execute();
            $row = $stmt->rowCount();
            return $row;
        }

        public function checkemail($email){
            $sql = "SELECT *FROM tbl_user WHERE u_email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1,$email);
            $stmt->execute();
            $row = $stmt->rowCount();
            return $row;
        }

        public function selectDatauser($username){
            $sql = "SELECT u_password FROM tbl_user WHERE u_username = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1,$username);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $row = $stmt->rowCount();
            if($row > 0){
               $data[0]["status"] = "success";
                return $data;
            }else{
                $data[0]["status"] = "fail";
                return $data;
            }
        }
    }
?>