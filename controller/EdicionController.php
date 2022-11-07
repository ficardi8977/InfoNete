<?php

class EdicionController {
    private $edicionModel;
    private $render;

    public function __construct($edicionModel, $render){

        $this->edicionModel = $edicionModel;
        $this->render = $render;
    }

    public function listar()
    {
        $data["ediciones"] = $this->edicionModel->getEdicionesPorProducto($_GET["IdProducto"]);
        echo $this->render->render("compraEdicionView.mustache", SesionData::cargar($data));
    }

    public function comprar()
    {
        $this->edicionModel->comprar($_POST["IdEdicion"], $_POST["Precio"] );
        echo Redirect::doIt("/edicion/listar?IdProducto=".$_POST["IdProducto"]);
    }

    public function misCompras()
    {
        $data['compras']= $this->edicionModel->listCompras();
        echo $this->render->render("misComprasView.mustache", SesionData::cargar($data));
    }

    public function detalle()
    {
        //$data['edicion'] = $this->edicionModel->abrir($_GET["IdEdicion"]);
        $data['edicion'] = "por ahora vacio la idea es abrir una lista de noticias que contiene la edicion";
        echo $this->render->render("detalleEdicionView.mustache", SesionData::cargar($data));
    }
}
?>
