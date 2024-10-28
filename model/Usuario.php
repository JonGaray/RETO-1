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
        $sql = "SELECT nombre, contrasenna, rol FROM " . $this->table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $resultado) {
            $map[$resultado['nombre']] = [
                'contrasenna' => $resultado['contrasenna'],
                'rol' => $resultado['rol']
            ];
        }
        if (isset($map[$nombreParam]) && $map[$nombreParam]['contrasenna'] === $contrasennaParam) {
            setcookie("nombre_usuario", $nombreParam, 0, "/");
            setcookie("rol_usuario", $map[$nombreParam]['rol'], 0, "/");
            return true; // Usuario encontrado y validado
        }
        return false; // Usuario no encontrado o credenciales incorrectas
    }
    public function updateUsuario($param){
        $sql = "UPDATE " .$this->table. " SET nombre=?, correo=?, contrasenna=? WHERE id=?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$param["nombre"], $param["correo"], $param["contrasenna"], $param["id"]]);

        return $param["id"];
    }
    public function getUserById($id)
    {
        if (is_null($id)) return false;
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function save($param){
        $nombre = $contrasenna = $correo = "";
        if (isset($param["nombre"])) $nombre = $param["nombre"];
        if (isset($param["contrasenna"])) $contrasenna = $param["contrasenna"];
        if (isset($param["correo"])) $correo = $param["correo"];
        $sql = "INSERT INTO " . $this->table . "(nombre, contrasenna, correo, rol) VALUES (?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$nombre, $contrasenna, $correo, "usuario"]);
        if ($stmt->rowCount() > 0) {
            $id = $this->connection->lastInsertId();
            header("Location: index.php?controller=usuario&action=listPreguntas");
            return $id;
        } else {
            throw new Exception("Inserción fallifa");
        }
    }

    public function actualizarFotoPerfil($usuarioId, $rutaFoto) {
        $sql = "UPDATE ".$this->table." SET foto = ? WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([$rutaFoto, $usuarioId]);
    }
}