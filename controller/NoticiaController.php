<?php
class NoticiaController {
    
    private $noticiaModel;
    private $render;
    private $sesion;

    public function __construct($noticiaModel, $render, $sesion){

        $this->noticiaModel = $noticiaModel;
        $this->render = $render;
        $this->sesion = $sesion;
    }

    public function alta()
    {
        echo $this->render->render("noticiaView.mustache");
    }

    public function publicar()
    {
        $titulo = $_POST["titulo"];
        $cuerpo = $_POST["cuerpo"];
        echo "hola";
        move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/" . $_FILES["imagen"]["name"]);
        $imagen = $_FILES["imagen"]["name"];
        
        $this->noticiaModel->addNoticia($titulo, $cuerpo, $imagen);
    }
}
