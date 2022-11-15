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
        Permisos::validarAcceso(Rol::Contenidista);
        $data['productos'] = $this->productoModel->getProductosConSuTipo();
        echo $this->render->render("edicionView.mustache", SesionData::cargar($data));
    }

    public function crearEdicion(){
        Permisos::validarAcceso(Rol::Contenidista);
        $data['producto']=$this->productoModel->getproductoConSuTipo($_GET['Id']);
        echo $this->render->render('crearEdicionForm.mustache', SesionData::cargar($data));
    }

    public function altaEdicion(){
        Permisos::validarAcceso(Rol::Contenidista);
        $numero = $_POST['numero'];
        $fecha = $_POST['fecha'];
        $precio = $_POST['precio'];
        $idProducto = $_POST['Id'];

        $this->edicionesModel->altaEdicion($numero, $idProducto, $fecha, $precio);

        echo Redirect::doIt("/ediciones/mostrarProducto");
    }

    public function mostrarEdiciones(){
        Permisos::validarAcceso(Rol::Contenidista);
        $idProducto = $_GET['Id'];
        $data['ediciones'] = $this->edicionesModel->getEdicionesPorIdProducto($idProducto);
        echo $this->render->render("showEdiciones.mustache", SesionData::cargar($data));
    }

    public function bajaEdicion(){
        Permisos::validarAcceso(Rol::Contenidista);
        $idEdicion = $_POST['Id'];
        $idProducto = $_POST['IdProducto'];
        $this->edicionesModel->baja($idEdicion);
        echo Redirect::doIt("/ediciones/mostrarEdiciones?Id=$idProducto");
    }

    public function volver(){
        Permisos::validarAcceso(Rol::Contenidista);
        echo Redirect::doIt("mostrarProducto");
    }

}