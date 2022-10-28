<?php
class SuscripcionController{
    private $suscripcion;
    private $render;
    private $sesion;


    public function __construct($suscripcion,$render, $sesion){
            $this->suscripcion = $suscripcion;
            $this->render = $render;
            $this->sesion = $sesion;
    }

    public function alta(){
             $idProducto=$_POST["Id"];  
             $this->suscripcion->alta($idProducto);
            $data= $this->mostrarSuscripciones();
            echo $this->render->render("suscripcionesView.mustache", $this->sesion->cargar($data));

    }

    public function mostrarSuscripciones(){
             return $data['suscripciones']= $this->suscripcion->listSuscripciones();
  
    }



}

?>