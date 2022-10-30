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

    public function baja($idProducto){
                $idUsuario = $_SESSION["IdUsuario"]; 
                $idProducto= $_POST["IdProducto"];
                /**
                 * delete from suscripcion where IdUsuario=3 and IdProducto=1 
                 */
                $sql = "DELETE from suscripcion where IdUsuario=".$idUsuario." and IdProducto=".$idProducto.";";
        $this->database->execute($sql);
    }

    /**
     * Lista todas las suscripciones del usuario que se encuentra en sesion.
     */

    public function listSuscripciones(){
         $idUsuario = $_SESSION["IdUsuario"]; 
        return $this->database->query("SELECT s.IdProducto,t.Nombre as NombreTipoProducto, s.FechaDesde,s.FechaHasta, p.Nombre as NombreProducto, p.Imagen
                from suscripcion s  inner join producto p on (s.IdProducto=p.Id)
                inner join tipoproducto t on (p.IdTipoProducto=t.Id)
                where s.IdUsuario=".$idUsuario.";"); 
    }

    public function buscarArticulo(){
           $idProducto=$_POST["Id"]; 
           $sql="SELECT * FROM PRODUCTO WHERE Id=".$idProducto.";";     
           $this->database->execute($sql);
    }
}
?>