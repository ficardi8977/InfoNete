<?php

class EdicionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getEdicionesDeProducto($idProducto)
    {
        $idUsuario = $_SESSION["IdUsuario"]; 
        return $this->database->query("SELECT e.Id, 
        e.Numero, 
        e.Fecha, 
        e.IdProducto,
        e.Precio,
        p.Imagen as ImagenProducto,
        p.Nombre as NombreProducto,
        case when c.id is not null
            then true
            else false 
            end Comprado
        FROM edicion e
        JOIN producto p on p.id = e.idproducto
        left join compra c on c.IdEdicion = e.Id and $idUsuario = c.IdUsuario 
        where e.IdProducto = $idProducto ORDER BY e.Numero");
    }

    
    public function getEdicionesPorProducto($idProducto)
    {
        $sql = "SELECT * FROM edicion WHERE idProducto = $idProducto";
        return $this->database->query($sql);
    }

    public function comprar($idEdicion, $precio)
    {
        $idUsuario = $_SESSION["IdUsuario"];

        $today = date('Y-m-d');
        $sql = "INSERT INTO compra (IdEdicion, IdUsuario, Precio, Pagado, FechaCompra)
        VALUES (" . $idEdicion . ",
            " . $idUsuario . ", 
            " . $precio . ",
            1,
            '" . $today . "')";

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
        e.Numero,
        p.Nombre as NombreProducto,
        p.Imagen as ImagenProducto,
        s.Id as IdSeccion, 
        s.Nombre as NombreSeccion,
        count(*) as CantidadNoticias
        FROM edicion e 
        join edicionseccion es on es.IdEdicion = e.Id
        join seccion s on s.Id = es.IdSeccion
        join producto p on p.id = e.idproducto
        join noticia n on n.IdEdicionSeccion = es.id
        where IdEdicion = $idEdicion and n.idEstadoNoticia = 3 group by  e.Numero,p.Nombre,p.Imagen, s.Id, s.Nombre");      
    }

    public function desasociarSeccion($idEdicion,$idSeccion)
    {
        $sql = "DELETE FROM edicionSeccion 
        WHERE IdEdicion = ".$idEdicion. 
        " AND IdSeccion = ".$idSeccion;
        
        return $this->database->execute($sql);
    }

    public function altaEdicion($numero, $idProducto, $fecha, $precio){
        $sql = ("INSERT INTO edicion(Numero, IdProducto, Fecha, precio) VALUES ('$numero', '$idProducto', '$fecha', $precio)");
        $this->database->execute($sql);
    }

    public function getEdicionesPorIdProducto($idProducto){
        $sql = ("SELECT Id, IdProducto, Numero, Fecha, precio
                 FROM edicion
                 WHERE IdProducto = '$idProducto'");
        return $this->database->query($sql);
    }

    public function baja($idEdicion){
        $sql = ("DELETE FROM edicion WHERE Id = '$idEdicion'");
        $this->database->execute($sql);
    }
}