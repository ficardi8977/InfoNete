<?php

class EdicionController {
    private $edicionModel;
    private $render;
    private $sesion;

    public function __construct($edicionModel, $render, $sesion){

        $this->edicionModel = $edicionModel;
        $this->render = $render;
        $this->sesion = $sesion;
    }

    public function listar()
    {
        $data["ediciones"] = $this->edicionModel->getEdicionesPorProducto($_GET["IdProducto"]);
        echo $this->render->render("compraEdicionView.mustache", $this->sesion->cargar($data));
    }

    public function comprar()
    {
        $this->edicionModel->comprar($_POST["IdEdicion"], $_POST["Precio"] );
        echo Redirect::doIt("/edicion/listar?IdProducto=".$_POST["IdProducto"]);
    }
}
?>
