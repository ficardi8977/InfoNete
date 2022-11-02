<?php

class EdicionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getEdicionesPorProducto($idProducto)
    {
        $idUsuario = $_SESSION["IdUsuario"]; 
        return $this->database->query("SELECT e.Id, 
        e.Numero, 
        e.Fecha, 
        e.IdProducto,
        e.Precio,
        case when ".$idUsuario." = c.IdUsuario 
            then true
            else false end Comprado
        FROM edicion e
        left join compra c on c.IdEdicion = e.Id
        where e.IdProducto = ". $idProducto);
    }

    public function comprar($idEdicion)
    {
        // por ahora el precio  viene estatico
        $precio = 100;

        $idUsuario = $_SESSION["IdUsuario"];

        $sql = "INSERT INTO compra (IdEdicion, IdUsuario, precio)
    VALUES (" . $idEdicion . ",
            " . $idUsuario . ", 
            " . $precio . ")";

        $this->database->execute($sql);        
    }
}