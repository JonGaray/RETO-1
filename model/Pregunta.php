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
        $sql = "SELECT preguntas.id, titulo, descripcion, categoria, u.nombre FROM " . $this->table . " JOIN usuarios u ON id_usuario = u.id ORDER BY preguntas.id DESC";
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
    public function getRespuestasByIdPregunta($id) {
        if (is_null($id)) return false;

        $sql = "SELECT 
        p.id AS pregunta_id,
        p.titulo AS pregunta_titulo,
        p.descripcion AS pregunta_descripcion,
        p.categoria AS pregunta_categoria,
        r.id AS respuesta_id,
        r.contenido AS respuesta_contenido,
        r.megusta AS respuesta_megusta,
        r.nomegusta AS respuesta_nomegusta,
        r.id_usuario AS respuesta_id_usuario,
        u_preguntador.id AS usuario_id_preguntador,
        u_preguntador.nombre AS usuario_nombre_preguntador,
        u_preguntador.correo AS usuario_correo_preguntador,
        u_respuesta.id AS usuario_id_respuesta,
        u_respuesta.nombre AS usuario_nombre_respuesta,
        u_respuesta.correo AS usuario_correo_respuesta 
    FROM " . $this->table . " p 
    JOIN respuestas r ON p.id = r.id_pregunta 
    JOIN usuarios u_respuesta ON r.id_usuario = u_respuesta.id
    JOIN usuarios u_preguntador ON p.id_usuario = u_preguntador.id
    WHERE p.id = ? ORDER BY respuesta_megusta DESC";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
        $dataToView = $statement->fetchAll(PDO::FETCH_ASSOC);
        $pregunta_id = $pregunta_titulo = $pregunta_descripcion = $pregunta_categoria = "";
        $respuesta_id = $respuesta_contenido = $respuesta_megusta = $respuesta_nomegusta = "";
        $usuario_id_preguntador = $usuario_nombre_preguntador = $usuario_correo_preguntador = "";
        $usuario_id_respuesta = $usuario_nombre_respuesta = $usuario_correo_respuesta = "";
        if (isset($dataToView[0])) {
            $pregunta_id = $dataToView[0]['pregunta_id'];
            $pregunta_titulo = htmlspecialchars($dataToView[0]['pregunta_titulo']);
            $pregunta_descripcion = htmlspecialchars($dataToView[0]['pregunta_descripcion']);
            $pregunta_categoria = htmlspecialchars($dataToView[0]['pregunta_categoria']);
            $usuario_id_preguntador = $dataToView[0]['usuario_id_preguntador'];
            $usuario_nombre_preguntador = htmlspecialchars($dataToView[0]['usuario_nombre_preguntador']);
            $usuario_correo_preguntador = htmlspecialchars($dataToView[0]['usuario_correo_preguntador']);
            foreach ($dataToView as $respuesta) {
                $respuesta_id = $respuesta['respuesta_id'];
                $respuesta_contenido = htmlspecialchars($respuesta['respuesta_contenido']);
                $respuesta_megusta = $respuesta['respuesta_megusta'];
                $respuesta_nomegusta = $respuesta['respuesta_nomegusta'];
                $usuario_id_respuesta = $respuesta['usuario_id_respuesta'];
                $usuario_nombre_respuesta = htmlspecialchars($respuesta['usuario_nombre_respuesta']);
                $usuario_correo_respuesta = htmlspecialchars($respuesta['usuario_correo_respuesta']);
            }
        }
        return $dataToView;
    }
    public function getPreguntasByUsuarioId($param){
            
        $sql = "SELECT titulo, descripcion FROM " .$this->table. " WHERE id_usuario = ?";
        $statement=$this->connection->prepare($sql);
        $statement->execute([$param]);
        return $statement->fetchAll();
    }
}