<?php
class BaseController {
    public function __construct() {
        $this->checkLogin();
    }
    public function checkLogin() {
        if (!isset($_COOKIE['nombre_usuario'])) {
            header('Location: index.php?controller=usuario&action=login');
            exit();
        }
    }
}
?>