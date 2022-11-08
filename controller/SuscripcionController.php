<?php
class SuscripcionController{
    private $suscripcion;
    private $render;
    private $producto;
    private $edicion;


    public function __construct($suscripcion,$render, $producto,$edicion){
            $this->suscripcion = $suscripcion;
            $this->render = $render;
            $this->producto= $producto;
            $this->edicion=$edicion;
    }

    public function mostrarAlta(){             
            Permisos::validarAcceso(Rol::Lector->value);    
             $idProducto = $_GET["IdProducto"];
             $data['producto']=$this->producto->getProducto($idProducto);
             echo $this->render->render("altaSuscripcionView.mustache", SesionData::cargar($data));
        }

    public function misSuscripciones(){
            Permisos::validarAcceso(Rol::Lector->value);            
            $data['suscripciones']= $this->suscripcion->listSuscripciones();
            echo $this->render->render("suscripcionesView.mustache", SesionData::cargar($data));
        }

    public function alta(){
            Permisos::validarAcceso(Rol::Lector->value);   
            $this->suscripcion->alta($_POST["IdProducto"], $_POST["PeriodoMensual"]);
            Redirect::doIt("/suscripcion/misSuscripciones");
        }

    public function baja(){
             Permisos::validarAcceso(Rol::Lector->value);   
             $idProducto=$_POST["IdProducto"];   
             $this->suscripcion->baja($idProducto);
             Redirect::doIt("/suscripcion/misSuscripciones");
    }

    public function ediciones(){
           Permisos::validarAcceso(Rol::Lector->value);   
           $data['ediciones'] = $this->suscripcion->getEdiciones($_GET['IdSuscripcion']);           
           echo $this->render->render("edicionesView.mustache",SesionData::cargar($data));
    }
}

?>