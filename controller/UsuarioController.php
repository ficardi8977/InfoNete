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
        echo $this->render->render("signinView.mustache");
    }

    public function verificar()
    {
        // llamar a metodo que envia mail con codigo
        echo $this->render->render("verificacionUsuarioView.mustache");
    }

}
?>