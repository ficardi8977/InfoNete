<?php

class HomeController {
    private $productoModel;
    private $render;

    public function __construct($productoModel, $render){

        $this->productoModel = $productoModel;
        $this->render = $render;
    }

    public function get()
    {
        if(isset($_SESSION["IdUsuario"]))
            $idUsuario = $_SESSION["IdUsuario"];
        else
            $idUsuario = NULL;
        $data["productos"] = $this->productoModel->getProductos($idUsuario);
        echo $this->render->render("CatalogoView.mustache", SesionData::cargar($data));
    }
}
?>