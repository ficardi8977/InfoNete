<?php

class GestionController {
    private $suscripcionModel;
    private $compraModel;
    private $render;

    public function __construct($suscripcionModel, $compraModel, $render){

        $this->suscripcionModel = $suscripcionModel;
        $this->compraModel = $compraModel;
        $this->render = $render;
    }

    public function vista()
    {
        echo $this->render->render("graficosView.mustache", SesionData::cargar());
    }

    public function pdfGraficos(){
        $html = $this->render->render("graficosView.mustache", SesionData::cargar());
        GeneradorPdf::generarPdf($html);
    }
}
?>