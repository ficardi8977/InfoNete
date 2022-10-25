<?php

class UsuarioController {
    private $usuarioModel;
    private $render;
    private $sesion;

    public function __construct($usuarioModel, $render,  $sesion){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
        $this->sesion = $sesion;
    }
  
    public function alta()
    {
        echo $this->render->render("signinView.mustache", $this->sesion->cargar());
    }

    public function verificar()
    {
        $nombre = $_POST["nombre"];
        $password = $_POST["contraseña"];
        $email = $_POST["email"];
        $coordenadasX = $_POST["coordenadasX"];
        $coordenadasY = $_POST["coordenadasY"];

        $this->usuarioModel->addUsuario($nombre, $password,$email,$coordenadasX,$coordenadasY);

        echo $this->render->render("verificacionUsuarioView.mustache");
    }

    public function login()
    {
        $nombre = $_POST["nombre"];
        $password = $_POST["password"];

        $result = $this->usuarioModel->getUsuario($nombre, $password); 
        
        if(isset($result[0]))
        {
            $this->sesion->guardar($result[0]["Nombre"], $result[0]["IdTipoUsuario"], true);
        }else
        {
            $this->sesion->logueado(false);
        }
        Redirect::doIt();
    }

    public function close()
    {
        session_destroy();
        Redirect::doIt();
    }

}
?>