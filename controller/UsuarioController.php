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
        if (!isset($_SESSION['is_logged_in'])||!$_SESSION['is_logged_in']){
            $row=$this->model->login();
            if ($row){
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "correo" => $row['correo']
                );
                header('Location: index.php');
            }else{
                $_SESSION['is_logged_in']=false;
                return;
            }
        }
        header('Location: index.php');
    }
}