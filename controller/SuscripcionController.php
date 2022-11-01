<?php
class SuscripcionController{
    private $suscripcion;
    private $render;
    private $sesion;
    private $producto;


    public function __construct($suscripcion,$render, $sesion ,$producto){
            $this->suscripcion = $suscripcion;
            $this->render = $render;
            $this->sesion = $sesion;
            $this->producto= $producto;
    }

    public function alta(){
             
             //$this->suscripcion->alta($idProducto);
             /** Crear pantalla para dar de alta suscripcion con  un rango de fechas */  
             $data['producto']=$this->producto->getProducto($_POST["Id"]);  
              
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