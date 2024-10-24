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
    public function list() {
        include_once "view/layout/header.php";
        $this->page_title = "Listado de Preguntas";
        $this->view = "list";
        $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limite = 9;
        $offset = ($paginaActual - 1) * $limite;
        $totalPreguntas = $this->model->contarPreguntas();
        $totalPaginas = ceil($totalPreguntas / $limite);
        $preguntas = $this->model->getPreguntasPaginadas($limite, $offset);
        $dataToView = [
            "data" => $preguntas ?? [],
            "paginaActual" => $paginaActual,
            "totalPaginas" => $totalPaginas
        ];
        // Renderizar la vista
        $this->renderView('pregunta/list.html', $dataToView);
    }
    private function renderView($view, $dataToView = []) {
        // Extrae las variables del array para que sean accesibles como variables normales en la vista
        extract($dataToView);
        // Cargar el archivo de vista
        require_once 'view/' . $view . '.php';
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
    public function detalle() {
        $this->view = "detalle";
        $pregunta = $this->model->getPreguntaById($_GET["id"]);
        $respuestas = $this->model->getRespuestasByIdPregunta($_GET["id"]);
        return ["pregunta"=>$pregunta,"respuestas"=>$respuestas];
    }
    public function delete(){
        $this->view = "";
        if (isset($_POST["id"])) {
            $result = $this->model->deletePreguntaById($_POST["id"]);
            if ($result) {
                header("Location: index.php?controller=pregunta&action=list");
                exit();
            } else {
                echo "Error al eliminar la pregunta.";
            }
        } else {
            echo "ID no proporcionado para la eliminación.";
            return false;
        }
    }
    public function listCategoria(){
        $this->page_title = "Listado de Preguntas";
        $this->view ='listCategoria';
        return $this->model->getPreguntaByCategoria($_POST["categoria"]);
    }
}
