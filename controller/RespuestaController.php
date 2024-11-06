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
    public function updatemegusta() {
        $this->view = "";
        $preguntaId = $_POST["pregunta_id"];
        $respuestaId = $_GET["id"];

        // Verificamos si el usuario está marcando o desmarcando el checkbox
        $accion = isset($_POST['megusta']) ? "add" : "remove";

        // Llamamos al modelo para actualizar
        $this->model->toggleMegusta($respuestaId, $accion);

        // Redirigimos de vuelta a la pregunta
        header("Location: index.php?controller=pregunta&action=detalle&id=" . $preguntaId);
    }

    public function updatenomegusta() {
        $this->view = "";
        $preguntaId = $_POST["pregunta_id"];
        $respuestaId = $_GET["id"];

        // Verificamos si el usuario está marcando o desmarcando el checkbox
        $accion = isset($_POST['nomegusta']) ? "add" : "remove";

        // Llamamos al modelo para actualizar
        $this->model->toggleNomegusta($respuestaId, $accion);

        // Redirigimos de vuelta a la pregunta
        header("Location: index.php?controller=pregunta&action=detalle&id=" . $preguntaId);
    }
    public function responder(){
        $this->view = "list";
        return $this->model->getPreguntaById($_GET["id"]);
    }
   public function save() {
    $this->view = "";

    // Verificar si se ha subido algún archivo
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
        // Obtener la extensión del archivo
        $fileType = strtolower(pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION));

        if (in_array($fileType, ["jpg", "jpeg", "png", "gif"])) {
            // Si es una imagen, procesarla como tal
            $imageData = file_get_contents($_FILES["archivo"]["tmp_name"]);
            $id = $this->model->insertarRespuesta($_POST, $imageData);
            $result = $this->model->getRespuestaById($id);
            $_POST["response"] = true;
            return $result;

        } elseif (in_array($fileType, ["txt", "pdf", "doc", "docx", "html"])) {
            // Si es un archivo de texto, procesarlo como tal
            $contenidoArchivo = file_get_contents($_FILES["archivo"]["tmp_name"]);
            $_POST["respuesta"] = $contenidoArchivo;
            $id = $this->model->insertarRespuestaPDF($_POST, $_FILES["archivo"]);
            $result = $this->model->getRespuestaById($id);
            $_POST["response"] = true;
            return $result;
        }
    } else {
        // Si no se ha subido ningún archivo, procesar solo el contenido de $_POST
        $id = $this->model->insertarRespuesta($_POST, null);
        $result = $this->model->getRespuestaById($id);
        $_POST["response"] = true;
        return $result;
    }
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
     public function vistaPDF()
    {
        $this->view = "vistaPDF";
        return $this->model->getPDF();

    }
    public function descargarPDF()
    {
         $this->model->descargarPDF($_GET["id"]);
    }
    public function subirPDF()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
            $this->model->insertarPDF($_POST['nombre'], $_FILES['archivo']);
        }
        $this->view = "subirPDF";

    }
    public function deletePDF()
    {
        $this->view = "vistaPDF";
        $this->model->eliminarPDF($_GET["id"]);
    }
    public function descargarPDFRespuesta()
    {
        $this->view = "";
        $this->model->descargarPDFRespuesta($_GET["id"]);
    }
}