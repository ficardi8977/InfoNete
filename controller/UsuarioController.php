<?php

class UsuarioController {
    private $usuarioModel;
    private $render;

    public function __construct($usuarioModel, $render){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
    }
  
    public function alta()
    {
        $data["session"] = $_SESSION;
        echo $this->render->render("signinView.mustache", $data);
    }

    public function verificar()
    {
        $nombre = $_POST["nombre"];
        $password = $_POST["contraseña"];
        $email = $_POST["email"];
        $coordenadasX = $_POST["coordenadasX"];
        $coordenadasY = $_POST["coordenadasY"];

        $this->usuarioModel->addUsuario($nombre, $password,$email,$coordenadasX,$coordenadasY);

        // llamar a metodo que envia mail con codigo
        echo $this->render->render("verificacionUsuarioView.mustache");
    }

}
?>