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
        $sql = "SELECT titulo, descripcion, categoria, u.nombre FROM " . $this->table . " JOIN usuarios u ON id_usuario = u.id";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}