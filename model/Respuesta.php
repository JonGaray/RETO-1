<?php
    class Respuesta{
        private $table = "respuestas";
        private $connection;
        public function __construct(){
            $this->getConnection();
        }
        public function getConnection(){
            $dbObj =new Db();
            $this->connection = $dbObj->conection_db;
        }
        public function getRespuestasByUsuarioId($param){
            
            $sql = "SELECT contenido, megusta, nomegusta, id FROM " .$this->table. " WHERE id_usuario = ?";
            $statement=$this->connection->prepare($sql);
            $statement->execute([$param]);
            return $statement->fetchAll();
        }
    
        public function updatemegusta($id){
            if (is_null($id)) return false;
            $sql = "UPDATE " . $this->table . " SET megusta = megusta + 1 WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        public function updatenomegusta($id){
            if (is_null($id)) return false;
            $sql = "UPDATE " . $this->table . " SET nomegusta = nomegusta + 1 WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        public function getPreguntaById($id){
            $sql= "SELECT p.titulo, p.descripcion, r.contenido FROM respuestas r INNER JOIN preguntas p ON r.id_pregunta = p.id WHERE p.id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
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
        public function insertarRespuesta($param){
            $idDeluser = $this->getIdbyNombre($_COOKIE["nombre_usuario"]);
            echo ($_COOKIE["nombre_usuario"]);
            $sql = "insert into " . $this->table . " (contenido, megusta, nomegusta, id_usuario, id_pregunta, fecha) values (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$param["respuesta"],0,0,$idDeluser["id"],$param["id_preg"], null]);
            if ($stmt->rowCount() > 0) {
                $id = $this->connection->lastInsertId();
                header("Location: index.php?controller=pregunta&action=list");
                return $id;
            } else {
                throw new Exception("Usuario no encontrado o no se pudo insertar la pregunta");
            }
        }
        public function deleteRespuestaById($id){
            if(is_null($id)) return false;
            $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([$id]);
        }
    }
