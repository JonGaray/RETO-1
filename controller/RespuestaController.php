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
        // Si se ha subido un archivo (tipo texto)
        if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
            $contenidoArchivo = file_get_contents($_FILES["archivo"]["tmp_name"]);
            $_POST["respuesta"] = $contenidoArchivo;
            $id = $this->model->insertarRespuesta($_POST, null);
            $result = $this->model->getRespuestaById($id);
            $_POST["response"] = true;
            return $result;
        } elseif (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES['foto']['tmp_name']);
            $id = $this->model->insertarRespuesta($_POST, $imageData);
            $result = $this->model->getRespuestaById($id);
            $_POST["response"] = true;
            return $result;
        } else {
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
    public function guardarFotoRespuesta() {
        if(isset($_FILES['foto'])) {
            // Ruta donde se guardarán las fotos
            $target_dir = "assets/Images/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validar que sea una imagen
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Actualizar la base de datos con la nueva ruta de la imagen
                    $this->model->insertarRespuesta($_POST, $target_file);

                    header("Location:index.php?controller=usuario&action=listPreguntas");
                } else {
                    echo "Error subiendo la imagen.";
                }
            } else {
                echo "El archivo no es una imagen.";
            }
        }
    }
    public function deletePDF()
    {
        $this->view = "vistaPDF";
        $this->model->eliminarPDF($_GET["id"]);
    }
}