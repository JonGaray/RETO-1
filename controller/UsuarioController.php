<?php
require_once "model/Usuario.php";
require_once "model/Respuesta.php";
require_once "model/Pregunta.php";


class UsuarioController{
    public $page_title;
    public $view;
    public $model;
    public $modelRespuestas;
    public $modelPreguntas;

    public function __construct()
    {
        $this->view = "list";
        $this->page_title = "";
        $this->model = new Usuario();
        $this->modelRespuestas = new Respuesta();
        $this->modelPreguntas = new Pregunta();
    }
    public function login(){
        $this->view = "login";
        $this->page_title = "Acceso a la p&aacute;gina";
        $this->model->getUserIntoArray($_POST);
        if ($this->model->getUserIntoArray($_POST)){
            header("Location:index.php?controller=pregunta&action=list");
            exit();
        }
    }
    public function listRespuestas(){

        $this->view = "usuario_respuestas";
        $this->page_title = "Editar usuario";
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $respuestas = $this->modelRespuestas->getRespuestasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);
        
        return ["usuario"=>$usuario,"respuestas"=>$respuestas];
    }
    public function updateUsuarioPreguntas(){
        $this->view = "usuario_preguntas";
        $this->page_title = "Editar usuario";

        $id = $this->model->updateUsuario($_POST);
        $result = $this->model->getUserById($id);
        $_GET["response"] = true;
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $preguntas = $this->modelPreguntas->getPreguntasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);

        return ["usuario"=>$usuario,"preguntas"=>$preguntas];
    }
    public function updateUsuarioRespuestas(){
        $this->view = "usuario_respuestas";
        $this->page_title = "Editar usuario";

        $id = $this->model->updateUsuario($_POST);
        $result = $this->model->getUserById($id);
        $_GET["response"] = true;
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $respuestas = $this->modelRespuestas->getRespuestasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);

        return ["usuario"=>$usuario,"respuestas"=>$respuestas];
    }
    public function listPreguntas(){
        $this->view = "usuario_preguntas";
        $this->page_title = "Editar usuario preguntas";
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $preguntas = $this->modelPreguntas->getPreguntasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);

        return ["usuario"=>$usuario,"preguntas"=>$preguntas];
    }

    public function deletePregunta(){
        $this->view = "usuario_preguntas";
        if (isset($_POST["id"])) {
            $result = $this->modelPreguntas->deletePreguntaById($_POST["id"]);
            if ($result) {
                header("Location: index.php?controller=usuario&action=listPreguntas");
                exit();
            } else {
                echo "Error al eliminar la pregunta.";
            }
        } else {
            echo "ID no proporcionado para la eliminación.";
            return false;
        }
    }
    public function deleteRespuesta(){
        $this->view = "usuario_respuestas";
        if (isset($_POST["id"])) {
            $result = $this->modelRespuestas->deleteRespuestaById($_POST["id"]);
            if ($result) {
                header("Location: index.php?controller=usuario&action=listRespuestas");
                exit();
            } else {
                echo "Error al eliminar la respuesta.";
            }
        } else {
            echo "ID no proporcionado para la eliminación.";
            return false;
        }
    }
    public function create(){
        $this->page_title = "Crear usuario";
        $this->view = "create";
    }
    public function save(){
    $this->page_title = "";
    $this->view = "create";
    $id = $this->model->save($_POST);
    $result = $this->model->getUserById($id);
    $_GET["response"] = true;
    return $result;
    }

    public function guardarFotoPerfilRespuestas() {
        if(isset($_FILES['foto'])) {
            // Ruta donde se guardarán las fotos
            $target_dir = "assets/Images/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validar que sea una imagen
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Actualizar la base de datos con la nueva ruta de la imagen
                    $this->model->actualizarFotoPerfil($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"], $target_file);

                    header("Location:index.php?controller=usuario&action=listRespuestas");
                } else {
                    echo "Error subiendo la imagen.";
                }
            } else {
                echo "El archivo no es una imagen.";
            }
        }
    }

    public function guardarFotoPerfilPreguntas() {
        if(isset($_FILES['foto'])) {
            // Ruta donde se guardarán las fotos
            $target_dir = "assets/Images/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validar que sea una imagen
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Actualizar la base de datos con la nueva ruta de la imagen
                    $this->model->actualizarFotoPerfil($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"], $target_file);

                    header("Location:index.php?controller=usuario&action=listPreguntas");
                } else {
                    echo "Error subiendo la imagen.";
                }
            } else {
                echo "El archivo no es una imagen.";
            }
        }
    }
}