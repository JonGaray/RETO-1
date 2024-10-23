<?php
require_once "model/Pregunta.php";
require_once "BaseController.php";

class PreguntaController extends BaseController
{
    public $page_title;
    public $view;
    public $model;

    public function __construct(){
        parent::__construct();
        $this->view = "list";
        $this->page_title = "";
        $this->model = new Pregunta();
    }
    public function list(){
        $this->page_title = "Listado de Preguntas";
        return $this->model->getPreguntas();
    }
    public function create(){
        $this->page_title = "Crear Pregunta";
        $this->view ='create';
    }
    public function save(){
        $this->page_title ='Crear Pregunta';
        $this->view ='create';
        $id =$this->model->save($_POST);
        $result = $this->model->getPreguntaById($id);
        $_GET["response"] = true;
        return $result;
    }
    public function detalle(){
        $this->view = "detalle";
        return $this->model->getRespuestasByIdPregunta($_GET["id"]);
    }
}
