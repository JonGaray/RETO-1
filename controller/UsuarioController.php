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
    public function update(){
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
}