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
            // Ruta donde se guardarán las fotos
            $target_dir = "assets/Images/respuestas/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Validar que el archivo sea una imagen
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Insertar respuesta en la base de datos con la ruta de la imagen
                    $id = $this->model->insertarRespuesta($_POST, $target_file);
                    $result = $this->model->getRespuestaById($id);
                    $_POST["response"] = true;
                    return $result;
                } else {
                    echo "Error subiendo la imagen.";
                }
            } else {
                echo "El archivo no es una imagen.";
            }
        } else {
            $id = $this->model->insertarRespuesta($_POST, null);
            $result = $this->model->getRespuestaById($id);
            $_POST["response"] = true;
            header("Location:index.php?controller=pregunta&action=list");
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
}