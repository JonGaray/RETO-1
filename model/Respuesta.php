<?php
    class Respuesta{
        private $table = "respuestas";
        private $connection;
        public function __construct(){
            $this->getConnection();
        }
        public function getConnection(){
            $dbObj =new Db();
            $this->connection = $dbObj->conection_db;
        }
        public function updatemegusta($id){
            if (is_null($id)) return false;
            $sql = "UPDATE " . $this->table . " SET megusta = megusta + 1 WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        public function updatenomegusta($id){
            if (is_null($id)) return false;
            $sql = "UPDATE " . $this->table . " SET nomegusta = nomegusta + 1 WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
    }