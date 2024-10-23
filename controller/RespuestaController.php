<?php
require_once "model/Respuesta.php";

class RespuestaController{
    public $page_title;
    public $view;
    public $model;

    public function __construct()
    {
        $this->view = "";
        $this->page_title = "";
        $this->model = new Respuesta();
    }
    public function updatemegusta(){
        $this->view = "";
        header("Location:index.php?controller=pregunta&action=list");
        return $this->model->updatemegusta($_GET["id"]);
    }
    public function updatenomegusta(){
        $this->view = "";
        header("Location:index.php?controller=pregunta&action=list");
        return $this->model->updatenomegusta($_GET["id"]);
    }
    public function responder(){
        $this->view = "list";
    }
    public function responderPregunta(){
        $this->view = "nada";
        return $this->model->insertarRespuesta($_GET);
    }
    public function deleteRespuestaById(){

    }
}