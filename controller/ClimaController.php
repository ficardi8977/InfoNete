<?php

class ClimaController{

    private $climaModel;
    private $render;

    public function __construct($climaModel, $render){

        $this->climaModel = $climaModel;
        $this->render = $render;
    }

    public function mostrarClima(){
        $data['productos'] = $this->climaModel->getProductos();
        echo $this->render->render('clima.mustache', SesionData::cargar($data));
    }
}