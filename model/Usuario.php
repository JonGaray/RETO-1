<?php
class Usuario{
    private $table = "usuarios";
    private $connection;
    public function __construct(){
        $this->getConnection();
    }
    public function getConnection(){
        $dbObj =new Db();
        $this->connection = $dbObj->conection_db;
    }
}