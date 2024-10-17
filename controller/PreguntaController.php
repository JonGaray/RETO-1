<?php
require_once "model/Pregunta.php";

class PreguntaController
{
    public $page_title;
    public $view;
    public $model;

    public function __construct()
    {
        $this->view = "list";
        $this->page_title = "";
        $this->model = new Pregunta();
    }
}
