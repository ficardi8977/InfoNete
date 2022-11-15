<?php
class EdicionesController{
    private $edicionesModel;
    private $render;
    private $productoModel;

    public function __construct($edicionesModel, $productoModel, $render){
        $this->edicionesModel = $edicionesModel;
        $this->render = $render;
        $this->productoModel = $productoModel;
    }

    public function mostrarProducto(){
        $data['productos'] = $this->productoModel->getProductosConSuTipo();
        echo $this->render->render("edicionView.mustache", SesionData::cargar($data));
    }

    public function crearEdicion(){
        $data['producto']=$this->productoModel->getproductoConSuTipo($_GET['Id']);
        echo $this->render->render('crearEdicionForm.mustache', SesionData::cargar($data));
    }

    public function altaEdicion(){
        $numero = $_POST['numero'];
        $fecha = $_POST['fecha'];
        $precio = $_POST['precio'];
        $idProducto = $_POST['Id'];

        $this->edicionesModel->altaEdicion($numero, $idProducto, $fecha, $precio);

        echo Redirect::doIt("/ediciones/mostrarProducto");
    }

    public function mostrarEdiciones(){
        $idProducto = $_GET['Id'];
        $data['ediciones'] = $this->edicionesModel->getEdicionesPorIdProducto($idProducto);
        echo $this->render->render("showEdiciones.mustache", SesionData::cargar($data));
    }

    public function bajaEdicion(){
        $idEdicion = $_POST['Id'];
        $this->edicionesModel->baja($idEdicion);
        echo Redirect::doIt("/ediciones/mostrarProducto");
    }

    public function volver(){
        echo Redirect::doIt("mostrarProducto");
    }

}