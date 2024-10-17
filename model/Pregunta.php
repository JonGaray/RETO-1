<?php
class Pregunta{
    private $table = "preguntas";
    private $connection;
    public function __construct(){
        $this->getConnection();
    }
    public function getConnection(){
        $dbObj =new Db();
        $this->connection = $dbObj->conection_db;
    }
    public function getPreguntas(){
        $sql = "SELECT titulo, descripcion, categoria, id_usuario FROM " . $this->table;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}