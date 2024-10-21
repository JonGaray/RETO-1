<?php
require_once "model/Usuario.php";
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
    public function save($param) {
        $titulo = $descripcion = $categoria = "";
        if (isset($param["titulo"])) $titulo = $param["titulo"];
        if (isset($param["descripcion"])) $descripcion = $param["descripcion"];
        if (isset($param["categoria"])) $categoria = $param["categoria"];
        $nombre = isset($_COOKIE['nombre_usuario']) ? $_COOKIE['nombre_usuario'] : null;
        if ($nombre) {
            $sql = "INSERT INTO " . $this->table . " (titulo, descripcion, categoria, id_usuario) SELECT ?, ?, ?, u.id FROM usuarios u WHERE u.nombre = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$titulo, $descripcion, $categoria, $nombre]);
            if ($stmt->rowCount() > 0) {
                $id = $this->connection->lastInsertId();
                header("Location: index.php?controller=pregunta&action=list");
                return $id;
            } else {
                throw new Exception("Usuario no encontrado o no se pudo insertar la pregunta");
            }
        } else {
            throw new Exception("No se ha iniciado sesión");
        }
    }


}