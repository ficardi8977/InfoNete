<?php

class GestionController {

    private $render;

    public function __construct($render){
        $this->render = $render;
    }

    public function vista()
    {
        Permisos::validarAcceso(Rol::Administrador);
        echo $this->render->render("graficosView.mustache", SesionData::cargar());
    }
}
?>