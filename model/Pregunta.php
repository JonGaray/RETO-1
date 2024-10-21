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
    public function getPreguntaById($id){
        if(is_null($id)) return false;
        $sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt-> execute([$id]);
        return $stmt->fetch();
    }
    public function save($param){
        $titulo = $descripcion = $categoria = $id_usuario = ""; //Hay qua cambiar el ID por el nombre (cookie)
        if(isset($param["titulo"])) $titulo = $param["titulo"];
        if(isset($param["descripcion"])) $descripcion = $param["descripcion"];
        if(isset($param["categoria"])) $categoria = $param["categoria"];
        if(isset($param["id_usuario"])) $id_usuario = $param["id_usuario"];
        $sql = "INSERT INTO ".$this->table. " (titulo, descripcion, categoria, id_usuario) values (?,?,?,?)";
        $stmt = $this-> connection->prepare($sql);
        $stmt-> execute([$titulo, $descripcion, $categoria, $id_usuario]);
        $id = $this ->connection-> lastInsertId();
        return $id;
    }
}