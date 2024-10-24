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
            
            $sql = "SELECT contenido, megusta, nomegusta FROM " .$this->table. " WHERE id_usuario = ?";
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
            $sql= "SELECT p.titulo, p.descripcion, r.contenido FROM respuestas r INNER JOIN preguntas p ON r.id_pregunta = p.id WHERE r.id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        public function getIdbyNombre($nombre){
            $sql = "SELECT r.id_usuario FROM respuestas r INNER JOIN usuarios u ON r.id_usuario = u.id WHERE u.nombre = ?;";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$nombre]);
            return $stmt->fetch();
        }
        public function insertarRespuesta($param){

            echo $param["id"] . "<br>";
            echo $param["user"] . "<br>";
            echo $param["respuesta"] . "<br>";
//            $idDeluser = $this->getIdbyNombre($param['nombre']);
//            $sql = "insert into " . $this->table . " (contenido, megusta, nomegusta, id_usuario, id_pregunta) values (?, ?, ?, ?, ?)";
//            $stmt = $this->connection->prepare($sql);
//            $stmt->execute([$param["respuesta"],0,0,$idDeluser,$param["id_pregunta"]]);
            header("Location:index.php?controller=pregunta&action=list");
            return 0;
        }
        public function deleteRespuestaById($id){
            if(is_null($id)) return false;
            $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([$id]);
        }
    }
