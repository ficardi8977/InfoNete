<?php

class HomeController {
    private $usuarioModel;
    private $render;

    public function __construct($usuarioModel, $render){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
    }

    public function session()
    {
        $nombre = $_POST["nombre"];
        $password = $_POST["password"];

        $result = $this->usuarioModel->getUsuario($nombre, $password); 

        if(isset($result[0]))
        {
            $_SESSION["Nombre"] = $result[0]["Nombre"];
            $_SESSION["IdTipoUsuario"] = $result[0]["IdTipoUsuario"];
            $data["mensaje"] = "";      
            $data["session"] = $_SESSION;
        }else
        {
            $data["mensaje"] = "Verificar usuario o contraseña ingresado";
        }

       echo $this->render->render("CatalogoView.mustache", $data);
    }
    
    public function get()
    {
        $data["session"] = $_SESSION;
        echo $this->render->render("CatalogoView.mustache", $data);
    }

    public function close()
    {
        session_destroy();
        echo $this->render->render("CatalogoView.mustache");
    }
}
?>