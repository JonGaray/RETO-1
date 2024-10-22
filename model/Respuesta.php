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
        public function getRespuestasByUsuarioId($param){
            
            $sql = "SELECT contenido, megusta, nomegusta FROM " .$this->table. " WHERE id_usuario = ?";
            $statement=$this->connection->prepare($sql);
            $statement->execute($param);
            return $statement->fetchAll();
        }
    }

    

