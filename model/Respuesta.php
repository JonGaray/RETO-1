<?php
    class Respuesta
    {
        private $table = "respuestas";
        private $connection;
        public function __construct(){
            $this->getConnection();
        }
        public function getConnection(){
            $dbObj = new Db();
            $this->connection = $dbObj->conection_db;
        }
        function getRespuestasByUsuarioId($param){
            $sql = "SELECT contenido, megusta, nomegusta, id, id_pregunta, foto FROM " . $this->table . " WHERE id_usuario = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$param]);
            return $statement->fetchAll();
        }
        public function toggleMegusta($id, $accion) {
            if (is_null($id)) return false;

            // Dependiendo de la acción (add o remove) actualizamos
            if ($accion == "add") {
                $sql = "UPDATE " . $this->table . " SET megusta = megusta + 1 WHERE id = ?";
            } else {
                $sql = "UPDATE " . $this->table . " SET megusta = megusta - 1 WHERE id = ? AND megusta > 0";
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount(); // Devolvemos el número de filas afectadas
        }

        public function toggleNomegusta($id, $accion) {
            if (is_null($id)) return false;

            // Dependiendo de la acción (add o remove) actualizamos
            if ($accion == "add") {
                $sql = "UPDATE " . $this->table . " SET nomegusta = nomegusta + 1 WHERE id = ?";
            } else {
                $sql = "UPDATE " . $this->table . " SET nomegusta = nomegusta - 1 WHERE id = ? AND nomegusta > 0";
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount(); // Devolvemos el número de filas afectadas
        }
        public function getPreguntaById($id){
            $sql = "SELECT p.titulo, p.descripcion FROM preguntas p WHERE p.id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getIdbyNombre($nombre){
            $sql = "SELECT id FROM usuarios WHERE nombre = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$nombre]);
            return $stmt->fetch();
        }
        public function getRespuestaById($id){
            if (is_null($id)) return false;
            $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        public function insertarRespuesta($param, $file){
            $idDeluser = $this->getIdbyNombre($_COOKIE["nombre_usuario"]);
            echo($_COOKIE["nombre_usuario"]);
            if (isset($param["respuesta"]) && $param["respuesta"] !== "") {
                $sql = "insert into " . $this->table . " (contenido, megusta, nomegusta, id_usuario, id_pregunta, fecha) values (?, ?, ?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$param["respuesta"], 0, 0, $idDeluser["id"], $param["id_preg"], null]);
                if ($stmt->rowCount() > 0) {
                    $id = $this->connection->lastInsertId();
                    header("Location: index.php?controller=pregunta&action=list");
                    return $id;
                } else {
                    throw new Exception("Usuario no encontrado o no se pudo insertar la pregunta");
                }
            } elseif (isset($file)) {
                $sql = "insert into " . $this->table . " (foto, megusta, nomegusta, id_usuario, id_pregunta, fecha) values (?, ?, ?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$file, 0, 0, $idDeluser["id"], $param["id_preg"], null]);
                if ($stmt->rowCount() > 0) {
                    $id = $this->connection->lastInsertId();
                    header("Location: index.php?controller=pregunta&action=list");
                    return $id;
                } else {
                    throw new Exception("Usuario no encontrado o no se pudo insertar la pregunta");
                }
            }
        }
        public function deleteRespuestaById($id){
            if (is_null($id)) return false;
            $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([$id]);
        }
        public function insertarPDF($nombre, $archivo){
            $id_usu = $this->getIdbyNombre($_COOKIE["nombre_usuario"]);
            // Verifica que el archivo fue cargado correctamente
            if ($archivo['error'] === UPLOAD_ERR_OK) {
                // Leer el archivo PDF en binario
                $pdfData = file_get_contents($archivo['tmp_name']);
                // Consulta SQL para insertar el archivo PDF
                $sql = "INSERT INTO reparacion (nombre, documento, id_usuario) VALUES (?, ?,?)";
                // Preparar la consulta
                $stmt = $this->connection->prepare($sql);
                // Ejecutar la consulta con los parámetros
                $stmt->execute([$nombre, $pdfData, $id_usu[0]]);
                header("Location: index.php?controller=respuesta&action=vistaPDF");
            }
        }
        public function descargarPDF($id){
            try {
                // Consulta para obtener el PDF en binario y el nombre del archivo
                $sql = "SELECT nombre ,documento FROM reparacion WHERE id_documento = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id[0]]);
                // Verificar si se encontró el archivo
                if ($stmt->rowCount() > 0) {
                    $documento = $stmt->fetch(PDO::FETCH_ASSOC);
                    $nombreArchivo = $documento['nombre'] . ".pdf";
                    $pdfData = $documento['archivo'];
                    // Enviar los encabezados para descargar el archivo
                    header("Content-Type: application/pdf");
                    header("Content-Disposition: attachment; filename=\"$nombreArchivo\"");
                    header("Content-Length: " . strlen($pdfData));
                    // Imprimir el contenido del archivo PDF
                    return $pdfData;
                    exit();
                } else {
                    throw new Exception("Archivo no encontrado.");
                }
            } catch (Exception $e) {
                echo "Error al descargar el archivo: " . $e->getMessage();
            }
        }
        public function getPDF(){
            $sql = "SELECT r.id_documento, r.nombre AS nombre_documento, r.documento, u.nombre AS nombre_usuario FROM reparacion r JOIN usuarios u ON r.id_usuario = u.id order by id_documento desc;";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function eliminarPDF($id)
        {
            $sql = "delete from reparacion where id_documento = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            header("Location: index.php?controller=respuesta&action=vistaPDF");
        }

            public function getImagenByIdPregunta($id){
                $sql = "SELECT foto FROM ".$this->table." WHERE id_pregunta = ?";
                    $stmt = $this->connection->prepare($sql);
                    $stmt->execute([$id]);
                    $imagen=$stmt->fetch();
                    return $imagen;
            }
}
