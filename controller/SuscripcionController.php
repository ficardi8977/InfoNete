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

    public function alta(){
             
             $idProducto = $_POST["Id"];
             //$this->suscripcion->alta($idProducto);
             /** Crear pantalla para dar de alta suscripcion con  un rango de fechas */  
             $data['producto']=$this->producto->getProducto($idProducto);  
    $data['ediciones']=$this->edicion->getEdicionesPorProducto($idProducto);
              echo $this->render->render("altaSuscripcionView.mustache", $this->sesion->cargar($data));

    }

    public function mostrarSuscripciones(){
            $data['suscripciones']= $this->suscripcion->listSuscripciones();
            echo $this->render->render("suscripcionesView.mustache", $this->sesion->cargar($data));

  
    }

    public function  altaSuscripcion(){
            $idProducto=$_POST["Id"];
            $fechaDesde=$_POST["fechaDesde"];    
            $fechaHasta=$_POST["fechaHasta"]; 
            $this->suscripcion->alta( $idProducto, $fechaDesde, $fechaHasta);
            Redirect::doIt("/suscripcion/mostrarSuscripciones");

    }

    public function baja(){
             $idProducto=$_POST["IdProducto"];   
             $this->suscripcion->baja($idProducto);
             Redirect::doIt("/suscripcion/mostrarSuscripciones");
    }

}

?>