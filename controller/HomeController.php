<?php

class HomeController {
    private $productoModel;
    private $render;
    private $sesion;

    public function __construct($productoModel, $render, $sesion){

        $this->productoModel = $productoModel;
        $this->render = $render;
        $this->sesion = $sesion;
    }

    public function get()
    {
        $data["productos"] = $this->productoModel->getProductos();
        echo $this->render->render("CatalogoView.mustache", $this->sesion->cargar($data));
    }
}
?>