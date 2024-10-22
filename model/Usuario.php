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
    public function getUserIdByNombre($nombre)
    {
        if (is_null($nombre)) return false;
        $sql = "SELECT id FROM " . $this->table . " WHERE nombre = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$nombre]);
        return $stmt->fetch();
    }
    public function getUserDataByNombre($nombre)
    {
        if (is_null($nombre)) return false;
        $sql = "SELECT * FROM " . $this->table . " WHERE nombre = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$nombre]);
        return $stmt->fetch();
    }
    public function getUserIntoArray($param){
        $map = array();
        $nombreParam = $param["nombre"] ?? null;
        $contrasennaParam = $param["contrasenna"] ?? null;
        $sql = "SELECT nombre, contrasenna FROM " . $this->table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $resultado) {
            $map[$resultado['nombre']] = $resultado['contrasenna'];
        }
        if (isset($map[$nombreParam]) && $map[$nombreParam] === $contrasennaParam) {
            setcookie("nombre_usuario", $nombreParam, 0, "/");
            return true; // Usuario encontrado y validado
        }
        return false; // Usuario no encontrado o credenciales incorrectas
    }
    

}