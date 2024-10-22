<?php
require_once "model/Usuario.php";
require_once "model/Respuesta.php";


class UsuarioController{
    public $page_title;
    public $view;
    public $model;
    public $modelRespuestas;

    public function __construct()
    {
        $this->view = "list";
        $this->page_title = "";
        $this->model = new Usuario();
        $this->modelRespuestas = new Respuesta();
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
    public function listPreguntas(){
        $this->view = "usuario_preguntas";
        $this->page_title = "Editar usuario";
        return $this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
    }
    public function listRespuestas(){
        $this->view = "usuario_respuestas";
        $this->page_title = "Editar usuario";
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);

        $dataToView["data"]["usuario"] = $usuario;

        include("view/usuario/usuario_respuestas.html.php");
    }
    public function getRespuestas(){
        $this->view = "usuario_respuestas";
        $this->page_title = "Editar usuario";
        $respuestas = $this->modelRespuestas->getRespuestasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"]));
        $dataToView["data"]["respuestas"] = $respuestas;

        include("view/usuario/usuario_respuestas.html.php");
    }
}