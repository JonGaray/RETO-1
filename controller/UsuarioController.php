<?php
require_once "model/Usuario.php";

class UsuarioController{
    public $page_title;
    public $view;
    public $model;

    public function __construct()
    {
        $this->view = "list";
        $this->page_title = "";
        $this->model = new Usuario();
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
}