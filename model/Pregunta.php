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
    public function getPreguntasPaginadas($limit, $offset){
        $sql = "SELECT p.id, p.titulo, p.descripcion, p.categoria, u.nombre FROM ". $this->table ." p JOIN usuarios u ON p.id_usuario = u.id ORDER BY p.id DESC LIMIT ? OFFSET ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $limit, PDO::PARAM_INT);
        $statement->bindValue(2, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function contarPreguntas(){
        $sql = "SELECT COUNT(*) as total FROM " . $this->table;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetch()['total'];
    }
    public function getCategorias(){
        $sql = "SELECT DISTINCT categoria FROM " . $this->table;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function contarPreguntasByCategoria($categoria){
        $sql = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE categoria = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$categoria]);
        return $statement->fetch()['total'];
    }
    public function deletePreguntaById($id){
        if(is_null($id)) return false;
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function getPreguntaById($id){
        if(is_null($id)) return false;
        $sql = "SELECT preguntas.id AS pregunta_id, titulo, descripcion, categoria, u.nombre FROM ".$this->table. " JOIN usuarios u ON id_usuario = u.id WHERE preguntas.id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt-> execute([$id]);
        return $stmt->fetch();
    }
    public function getPreguntaByCategoria($categoria){
        if(is_null($categoria)) return false;
        $sql = "SELECT preguntas.id AS pregunta_id, titulo, descripcion, categoria, u.nombre FROM ".$this->table. " JOIN usuarios u ON id_usuario = u.id WHERE preguntas.categoria = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt-> execute([$categoria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPreguntasPaginadasByCategoria($limit, $offset, $categoria){
        $sql = "SELECT preguntas.id AS pregunta_id, titulo, descripcion, categoria, u.nombre FROM ". $this->table ." JOIN usuarios u ON id_usuario = u.id WHERE preguntas.categoria = ? ORDER BY preguntas.id DESC LIMIT ? OFFSET ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $categoria, PDO::PARAM_STR);
        $statement->bindValue(2, $limit, PDO::PARAM_INT);
        $statement->bindValue(3, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
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
        r.foto AS respuesta_foto,
        r.archivo AS respuesta_archivo,
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
        $pregunta = [];
        $respuestas = [];
        if (isset($dataToView[0])) {
            $pregunta = [
                'pregunta_id' => $dataToView[0]['pregunta_id'],
                'titulo' => htmlspecialchars($dataToView[0]['pregunta_titulo']),
                'descripcion' => htmlspecialchars($dataToView[0]['pregunta_descripcion']),
                'categoria' => htmlspecialchars($dataToView[0]['pregunta_categoria']),
                'usuario_id_pregunta' => $dataToView[0]['usuario_id_preguntador'],
                'usuario_nombre_pregunta' => htmlspecialchars($dataToView[0]['usuario_nombre_preguntador']),
                'usuario_correo_pregunta' => htmlspecialchars($dataToView[0]['usuario_correo_preguntador']),
            ];
                foreach ($dataToView as $respuesta) {
                    $foto = $respuesta['respuesta_foto'];
                    $fotoBase64 = null;
        
                    // Si hay datos de imagen, procesarlos
                    if ($foto) {
                        // Detecta el tipo MIME de la imagen
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $imageType = finfo_buffer($finfo, $foto);
                        finfo_close($finfo);
        
                        // Convierte la imagen en base64 y aplica el formato
                        $fotoBase64 = 'data:' . $imageType . ';base64,' . base64_encode($foto);
                    }
                $respuestas[] = [
                    'id' => $respuesta['respuesta_id'],
                    'contenido' => ($respuesta['respuesta_contenido']),
                    'megusta' => $respuesta['respuesta_megusta'],
                    'nomegusta' => $respuesta['respuesta_nomegusta'],
                    'usuario_id_respuesta' => $respuesta['usuario_id_respuesta'],
                    'foto' => $fotoBase64,
                    'archivo' => $respuesta['respuesta_archivo'],
                    'usuario_nombre_respuesta' => htmlspecialchars($respuesta['usuario_nombre_respuesta']),
                    'usuario_correo_respuesta' => htmlspecialchars($respuesta['usuario_correo_respuesta']),
                ];
            }
        }
        
        return [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            
        ];
    }
    public function getPreguntasByUsuarioId($param){
            
        $sql = "SELECT titulo, descripcion, id FROM " .$this->table. " WHERE id_usuario = ?";
        $statement=$this->connection->prepare($sql);
        $statement->execute([$param]);
        return $statement->fetchAll();
    }
}