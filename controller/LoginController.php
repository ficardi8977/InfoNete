<?php

class LoginController {
    private $usuarioModel;
    private $render;

    public function __construct($usuarioModel, $render){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
    }

    public function procesarLogin(){
        $nombre = $_POST["nombre"];
        $password = $_POST["password"];

        $data["usuario"] = $this->usuarioModel->getUsuario($nombre, $password);

        echo $this->render->render("view/homeView.php", $data);
    }
    
    public function execute()
    {
        echo $this->render->render("view/loginView.php");
    }
}