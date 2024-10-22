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
    }

    