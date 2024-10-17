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
    public function getUserByNombre($nombre)
    {
        if (is_null($nombre)) return false;
        $sql = "SELECT * FROM " . $this->table . " WHERE nombre = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$nombre]);
        return $stmt->fetch();
    }
    public function login(){
        $post =filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($post["submit"])){
            $storedUser = $this->getUserByNombre($post["nombre"]);
            if (isset($storedUser["nombre"]) && password_verify($post["contrasenna"], $storedUser["contrasenna"])){
                return $storedUser;
            }
        }
        return;
    }
}