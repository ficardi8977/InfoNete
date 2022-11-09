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
        p.Imagen as ImagenProducto,
        p.Nombre as NombreProducto,
        case when ".$idUsuario." = c.IdUsuario 
            then true
            else false 
            end Comprado
        FROM edicion e
        JOIN producto p on p.id = e.idproducto
        left join compra c on c.IdEdicion = e.Id
        where e.IdProducto = ". $idProducto);
    }

    public function comprar($idEdicion, $precio)
    {
        $idUsuario = $_SESSION["IdUsuario"];

        $sql = "INSERT INTO compra (IdEdicion, IdUsuario, precio)
    VALUES (" . $idEdicion . ",
            " . $idUsuario . ", 
            " . $precio . ")";

        $this->database->execute($sql);        
    }

    public function listCompras()
    {
        $idUsuario = $_SESSION["IdUsuario"];
        return $this->database->query(
        "select
        p.Imagen as ImagenProducto,
        p.Nombre as NombreProducto,
        tp.Nombre as TipoProducto,
        e.id as IdEdicion,
        e.Numero as NumeroEdicion,
        e.Fecha as FechaEdicion,
        c.Precio as PrecioCompra,
        c.Pagado
        from compra c
        join edicion e on e.id = c.IdEdicion
        join producto p on p.id = e.IdProducto
        join tipoproducto tp on tp.id = p.IdTipoProducto
        where c.IdUsuario = ".$idUsuario);      
    }
}