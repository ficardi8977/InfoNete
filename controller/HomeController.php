<?php

class HomeController {
    private $usuarioModel;
    private $render;

    public function __construct($usuarioModel, $render){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
    }

    public function session(){
        $nombre = $_POST["nombre"];
        $password = $_POST["password"];

        $data["usuario"] = $this->usuarioModel->getUsuario($nombre, $password);

        echo $this->render->render("CatalogoView.mustache", $data);
    }
    
    public function get()
    {
        echo $this->render->render("CatalogoView.mustache");
    }
}
?>