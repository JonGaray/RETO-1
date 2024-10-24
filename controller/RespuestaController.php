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
        header("Location:index.php?controller=pregunta&action=detalle&id=".($_POST["pregunta_id"]));
        return $this->model->updatemegusta($_GET["id"]);
    }
    public function updatenomegusta(){
        $this->view = "";
        header("Location:index.php?controller=pregunta&action=detalle&id=".($_POST["pregunta_id"]));
        return $this->model->updatenomegusta($_GET["id"]);
    }
    public function responder(){
        $this->view = "list";

    }
    public function save(){
        $this->view = "nada";
        $id = $this->model->insertarRespuesta($_POST);

        // return $this->model->insertarRespuesta($_POST);
        $result = $this->model->getRespuestaById($id);
        $_POST["response"] = true;
        return $result;
    }
    public function delete(){
        $this->view = "";
        if (isset($_POST["id"]) && isset($_POST["pregunta_id"])) {
            $result = $this->model->deleteRespuestaById($_POST["id"]);
            if ($result) {
                header("Location: index.php?controller=pregunta&action=detalle&id=".($_POST["pregunta_id"]));
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