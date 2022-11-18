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
        $sql = "SELECT * FROM edicion WHERE idProducto = $idProducto";
        return $this->database->query($sql);
    }

    public function comprar($idEdicion, $precio)
    {
        $idUsuario = $_SESSION["IdUsuario"];

        $sql = "INSERT INTO compra (IdEdicion, IdUsuario, Precio, Pagado)
        VALUES (" . $idEdicion . ",
            " . $idUsuario . ", 
            " . $precio . ",
            1)";

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

    public function listSecciones($idEdicion)
    {
        return $this->database->query(
        "SELECT 
        e.Id as IdEdicion, 
        e.Numero as NumeroEdicion, 
        s.Id as IdSeccion, 
        s.Nombre as NombreSeccion,
        p.nombre as NombreProducto 
        FROM edicion e 
        join edicionseccion es on es.IdEdicion = e.Id
        join seccion s on s.Id = es.IdSeccion
        join producto p on p.id = e.idproducto
        where IdEdicion = ".$idEdicion);      
    }

    public function asociarSeccion($idEdicion,$idSeccion)
    {
        $sql = "INSERT INTO edicionSeccion (idEdicion,idSeccion)
        VALUES(".$idEdicion.",".$idSeccion.")";
        
        return $this->database->execute($sql);
    }

    public function desasociarSeccion($idEdicion,$idSeccion)
    {
        $sql = "DELETE FROM edicionSeccion 
        WHERE IdEdicion = ".$idEdicion. 
        " AND IdSeccion = ".$idSeccion;
        
        return $this->database->execute($sql);
    }
}