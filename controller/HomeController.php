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
        $data["productos"] = $this->productoModel->getProductos();
        echo $this->render->render("CatalogoView.mustache", SesionData::cargar($data));
    }
}
?>