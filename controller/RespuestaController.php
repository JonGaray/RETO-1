<?php
require_once "model/Respuesta.php";

class RespuestaController{
    public $page_title;
    public $view;
    public $model;

    public function __construct()
    {
        $this->view = "nada";
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
        echo "Método responderPregunta invocado";
        echo "<pre>";
        print_r($_GET);
        echo "</pre>";


        $this->view = "nada";
        echo $_GET["id"];
        return $this->model->insertarRespuesta($_GET);
    }
    public function deleteRespuestaById(){

        $this->view = "";
        if (isset($_POST["id"])) {
            $result = $this->model->deleteRespuestaById($_POST["id"]);
            if ($result) {
                header("Location: index.php?controller=pregunta&action=detalle&id=".($_POST["id"]));
                exit();
            } else {
                echo "Error al eliminar la respuesta.";
            }
        } else {
            echo "ID no proporcionado para la eliminación.";
            return false;
        }

    }
}