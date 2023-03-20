<?php
    class kamen{
        protected $pdo = null;
    
        function __construct(){
            $this->connect();
        }
    
        private function connect(){
            $this->pdo = new PDO('mysql: host=localhost; dbname=kamennrider','root','');
        }

        public function checkemail($email){
            $sql = "SELECT *FROM tbl_kamenrider";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
?>