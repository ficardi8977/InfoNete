<?php
class SuscripcionController{
    private $suscripcion;
    private $render;
    private $sesion;
    private $producto;
    private $edicion;


    public function __construct($suscripcion,$render, $sesion ,$producto,$edicion){
            $this->suscripcion = $suscripcion;
            $this->render = $render;
            $this->sesion = $sesion;
            $this->producto= $producto;
            $this->edicion=$edicion;
    }

    public function mostrarAlta(){             
             $idProducto = $_GET["IdProducto"];
             $data['producto']=$this->producto->getProducto($idProducto);
             echo $this->render->render("altaSuscripcionView.mustache", $this->sesion->cargar($data));
        }

    public function misSuscripciones(){
            $data['suscripciones']= $this->suscripcion->listSuscripciones();
            echo $this->render->render("suscripcionesView.mustache", $this->sesion->cargar($data));
        }

    public function alta(){
            $this->suscripcion->alta($_POST["IdProducto"], $_POST["PeriodoMensual"]);
            Redirect::doIt("/suscripcion/misSuscripciones");
        }

    public function baja(){
             $idProducto=$_POST["IdProducto"];   
             $this->suscripcion->baja($idProducto);
             Redirect::doIt("/suscripcion/misSuscripciones");
    }

    public function ediciones(){
           $data['ediciones'] = $this->suscripcion->getEdiciones($_GET['IdSuscripcion']);           
           echo $this->render->render("edicionesView.mustache",$this->sesion->cargar($data));
    }
}

?>