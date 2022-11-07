<?php

class SuscripcionModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function alta( $idProducto, $periodoMensual){
        $idUsuario = $_SESSION["IdUsuario"];
        $fechaDesde = date('Y-m-d');
        $fechaHasta = date('Y-m-d', strtotime('+'.$periodoMensual.' month', strtotime($fechaDesde)));
        $precioCalculado = $this->calcularPrecio($idProducto, $periodoMensual);

        $sql = "INSERT INTO suscripcion (idUsuario, IdProducto, FechaDesde,FechaHasta, Precio)
        VALUES ('".$idUsuario."',
        '".$idProducto."', 
        '".$fechaDesde."', 
        '".$fechaHasta."', 
        ".$precioCalculado.")";
             
     $this->database->execute($sql);        
}

    public function baja($idProducto){
                $idUsuario = $_SESSION["IdUsuario"]; 
                $idProducto= $_POST["IdProducto"];
                /**
                 * delete from suscripcion where IdUsuario=3 and IdProducto=1 
                 */
                $sql = "DELETE from suscripcion where IdUsuario=".$idUsuario." and IdProducto=".$idProducto.";";
        $this->database->execute($sql);
    }
    private function calcularPrecio($idProducto, $periodo)
    {
        $result =  $this->database->query("select Mensualidad * ".$periodo." as calculo
        from producto
        where id = ".$idProducto); 
        return $result[0]["calculo"];
    }

    /**
     * Lista todas las suscripciones del usuario que se encuentra en sesion.
     */

    public function listSuscripciones(){
         $idUsuario = $_SESSION["IdUsuario"]; 
        return $this->database->query("SELECT s.Id, s.IdProducto,t.Nombre as NombreTipoProducto, s.FechaDesde,s.FechaHasta, p.Nombre as NombreProducto, p.Imagen
                from suscripcion s  inner join producto p on (s.IdProducto=p.Id)
                inner join tipoproducto t on (p.IdTipoProducto=t.Id)
                where s.IdUsuario=".$idUsuario.";"); 
    }

    public function buscarArticulo(){
           $idProducto=$_POST["Id"]; 
           $sql="SELECT * FROM PRODUCTO WHERE Id=".$idProducto.";";     
           $this->database->execute($sql);
    }

    public function getEdiciones($idSuscripcion)
    {
        $idUsuario = $_SESSION["IdUsuario"]; 

        return $this->database->query("SELECT 
        e.Id, 
        e.Numero, 
        e.Fecha, 
        e.IdProducto,
        s.Precio,
        p.Imagen as ImagenProducto,
        p.Nombre as NombreProducto,
        s.FechaDesde,
        s.FechaHasta,
        case when e.id is not null
            then true 
            else false 
        end PermiteLectura
        FROM suscripcion s 
        JOIN producto p on p.id = s.idproducto
        left join edicion e on e.IdProducto = p.Id and s.FechaDesde <= e.fecha and s.FechaHasta >= e.Fecha
        where s.id = ".$idSuscripcion." and s.idUsuario = ".$idUsuario);
    }
}
?>