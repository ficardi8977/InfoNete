<?php

class SuscripcionModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    /**
     * id (es autoincrement), idusuario, idProducto, FechaDesde, FechaHasta,Precio
     */
    public function alta( $idProducto, $FechaDesde = '2022-10-01', $FechaHasta = '2022-10-30', $precio=1000){
            $idUsuario = $_SESSION["IdUsuario"];
            $sql = "INSERT INTO suscripcion (idUsuario, IdProducto, FechaDesde,FechaHasta, Precio)
    VALUES ('".$idUsuario."',
            '".$idProducto."', 
            '".$FechaDesde."', 
            '".$FechaHasta."', 
            ".$precio.")";
                 
    $this->database->execute($sql);


    }

  

    public function baja(){

    }

    public function listSuscripciones(){

    }
}
?>