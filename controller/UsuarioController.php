<?php

class UsuarioController {
    private $usuarioModel;
    private $render;

    public function __construct($usuarioModel, $render){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
    }
  
    public function registrar()
    {
        echo $this->render->render("view/registrarView.php");
    }
}
?>