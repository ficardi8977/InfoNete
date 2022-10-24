<?php

class HomeController {
    private $usuarioModel;
    private $productoModel;
    private $render;

    public function __construct($usuarioModel, $productoModel, $render){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
        $this->productoModel = $productoModel;
    }

    public function session()
    {
        $nombre = $_POST["nombre"];
        $password = $_POST["password"];

        $data["productos"] = $this->productoModel->getProductos();
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
        $data["productos"] = $this->productoModel->getProductos();
        echo $this->render->render("CatalogoView.mustache", $data);
    }

    public function close()
    {
        session_destroy();
        $data["productos"] = $this->productoModel->getProductos();
        echo $this->render->render("CatalogoView.mustache",$data);
    }
}
?>