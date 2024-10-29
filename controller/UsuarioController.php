<?php
require_once "model/Usuario.php";
require_once "model/Respuesta.php";
require_once "model/Pregunta.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // Asegúrate de que Composer ha instalado PHPMailer correctamente.



class UsuarioController{
    public $page_title;
    public $view;
    public $model;
    public $modelRespuestas;
    public $modelPreguntas;

    public function __construct()
    {
        $this->view = "list";
        $this->page_title = "";
        $this->model = new Usuario();
        $this->modelRespuestas = new Respuesta();
        $this->modelPreguntas = new Pregunta();
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
    public function listRespuestas(){

        $this->view = "usuario_respuestas";
        $this->page_title = "Editar usuario";
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $respuestas = $this->modelRespuestas->getRespuestasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);
        
        return ["usuario"=>$usuario,"respuestas"=>$respuestas];
    }
    public function updateUsuarioPreguntas(){
        $this->view = "usuario_preguntas";
        $this->page_title = "Editar usuario";

        $id = $this->model->updateUsuario($_POST);
        $result = $this->model->getUserById($id);
        $_GET["response"] = true;
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $preguntas = $this->modelPreguntas->getPreguntasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);

        return ["usuario"=>$usuario,"preguntas"=>$preguntas];
    }
    public function updateUsuarioRespuestas(){
        $this->view = "usuario_respuestas";
        $this->page_title = "Editar usuario";

        $id = $this->model->updateUsuario($_POST);
        $result = $this->model->getUserById($id);
        $_GET["response"] = true;
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $respuestas = $this->modelRespuestas->getRespuestasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);

        return ["usuario"=>$usuario,"respuestas"=>$respuestas];
    }
    public function listPreguntas(){
        $this->view = "usuario_preguntas";
        $this->page_title = "Editar usuario preguntas";
        $usuario=$this->model->getUserDataByNombre($_COOKIE["nombre_usuario"]);
        $preguntas = $this->modelPreguntas->getPreguntasByUsuarioId($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"]);

        return ["usuario"=>$usuario,"preguntas"=>$preguntas];
    }

    public function deletePregunta(){
        $this->view = "usuario_preguntas";
        if (isset($_POST["id"])) {
            $result = $this->modelPreguntas->deletePreguntaById($_POST["id"]);
            if ($result) {
                header("Location: index.php?controller=usuario&action=listPreguntas");
                exit();
            } else {
                echo "Error al eliminar la pregunta.";
            }
        } else {
            echo "ID no proporcionado para la eliminación.";
            return false;
        }
    }
    public function deleteRespuesta(){
        $this->view = "usuario_respuestas";
        if (isset($_POST["id"])) {
            $result = $this->modelRespuestas->deleteRespuestaById($_POST["id"]);
            if ($result) {
                header("Location: index.php?controller=usuario&action=listRespuestas");
                exit();
            } else {
                echo "Error al eliminar la respuesta.";
            }
        } else {
            echo "ID no proporcionado para la eliminación.";
            return false;
        }
    }
    public function create(){
        $this->page_title = "Crear usuario";
        $this->view = "create";
    }
    public function save(){
    $this->page_title = "";
    $this->view = "create";
    $id = $this->model->save($_POST);
    $result = $this->model->getUserById($id);
    $_GET["response"] = true;
    return $result;
    }

    public function enviarMail() {
        // Verifica que se haya accedido correctamente
        if (isset($_GET['controller']) && $_GET['controller'] === 'Usuario' &&
            isset($_GET['action']) && $_GET['action'] === 'enviarMail') {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Captura y sanitiza los datos del formulario
                $correo = filter_input(INPUT_POST, 'correo-contacto', FILTER_SANITIZE_EMAIL);
                $descripcion = htmlspecialchars($_POST['descripcion-contacto']);

                // Crea una instancia de PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // Habilita la depuración de SMTP
                    $mail->SMTPDebug = 2; // Cambiar a 0 en producción para desactivar los mensajes de depuración
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'aergibide@gmail.com'; // Cambia a tu dirección de Gmail
                    $mail->Password = 'uhrb vnth qtuj lfea'; // Cambia a la contraseña de aplicación generada en Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Usar 'ssl' si 'ENCRYPTION_SMTPS' falla
                    $mail->Port = 587;

                    // Configuración del remitente y destinatario
                    $mail->setFrom('aergibide@gmail.com', 'Formulario de Contacto'); // Usa tu dirección Gmail aquí
                    $mail->addAddress('aergibide@gmail.com'); // Cambia a la dirección de destino deseada
                    $mail->addReplyTo($correo);

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Nuevo mensaje de contacto';
                    $mail->Body = "Correo del remitente: $correo<br><br>Mensaje:<br>$descripcion";

                    // Enviar el correo
                    $mail->send();
                    echo "Correo enviado con éxito.";
                } catch (Exception $e) {
                    echo "Error al enviar el correo: {$mail->ErrorInfo}";
                }
            } else {
                echo "Método de solicitud no válido.";
            }
        } else {
            echo "Acceso no permitido.";
        }

        // Redirigir al usuario después de enviar el correo
        header("Location: index.php?controller=pregunta&action=list");
        exit();
}

    public function guardarFotoPerfilRespuestas() {
        if(isset($_FILES['foto'])) {
            // Ruta donde se guardarán las fotos
            $target_dir = "assets/Images/fotos-perfil/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validar que sea una imagen
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Actualizar la base de datos con la nueva ruta de la imagen
                    $this->model->actualizarFotoPerfil($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"], $target_file);

                    header("Location:index.php?controller=usuario&action=listRespuestas");
                } else {
                    echo "Error subiendo la imagen.";
                }
            } else {
                echo "El archivo no es una imagen.";
            }
        }
    }

    public function guardarFotoPerfilPreguntas() {
        if(isset($_FILES['foto'])) {
            // Ruta donde se guardarán las fotos
            $target_dir = "assets/Images/fotos-perfil/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validar que sea una imagen
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Actualizar la base de datos con la nueva ruta de la imagen
                    $this->model->actualizarFotoPerfil($this->model->getUserIdByNombre($_COOKIE["nombre_usuario"])["id"], $target_file);

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