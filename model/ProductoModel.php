<?php

class ProductoModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    
    public function getproductos($idUsuario) {
        $productos = $this->database->query("SELECT Nombre, Imagen, Id
        FROM producto;");
        if($idUsuario){
            $suscripciones = $this->database->query("SELECT IdProducto 
            FROM suscripcion WHERE IdUsuario = $idUsuario;");
            foreach ($productos as $keyP => $valueP) {
                foreach ($suscripciones as $valueS) {
                    if($valueP["Id"] == $valueS["IdProducto"])
                        $productos[$keyP]["suscripto"] = true;
                }
            }
        }
        return $productos;
    }

    public function getproducto($idProducto)  {
        return $this->database->query("SELECT * FROM producto WHERE id= ".$idProducto.";");
    }
   
     public function getproductoConSuTipo($idProducto){
        return $this->database->query("SELECT p.Id as Id, p.nombre as Nombre , p.Imagen as Imagen, t.nombre as NombreTipoProducto ,
        case  
        when p.IdTipoProducto = 1 then true
        else false
        end as EsDiario,
        p.Mensualidad
        from producto p inner join tipoproducto t on (p.IdTipoProducto=t.Id) where p.Id =".$idProducto.";");
    }
    
    public function getProductosConSuTipo(){
        return $this->database->query("SELECT p.Id as Id, p.nombre as Nombre , p.Imagen as Imagen, t.nombre as NombreTipoProducto
        from producto p inner join tipoproducto t on (p.IdTipoProducto=t.Id)");
    }

    public function bajaProducto($idProducto){

        $sql=("DELETE from producto where Id=$idProducto;");
        $this->database->execute($sql);
    }

    public function getTiposProducto(){
        return $this->database->query("SELECT * FROM tipoproducto ;");
    }

    public function altaProducto($nombreProducto,$tipoProducto,$imagen,$mensualidad){
        $sql=("INSERT INTO producto( Nombre, IdTipoProducto, Imagen,mensualidad) VALUES ('$nombreProducto',$tipoProducto,'$imagen',$mensualidad)");
         $this->database->execute($sql);
    }

    public function updateProducto($idProducto,$imagen,$nombreProducto,$tipoProducto, $mensualidad){
        $sql=("UPDATE producto SET Nombre='$nombreProducto',IdTipoProducto=$tipoProducto,Imagen='$imagen', Mensualidad=$mensualidad WHERE Id=$idProducto;");
        $this->database->execute($sql);
    }

    public function reporteConCantidades(){
        return $this->database->query("SELECT p.Id,
        p.Nombre,
        tp.Nombre as tipoproducto,
        (select count(*) from edicion e where e.IdProducto = p.id) as cantidadEdiciones,
        (select count(*) from suscripcion s where s.IdProducto = p.id) as cantidadSuscripciones,
        (select count(*) from compra c join edicion ed2 on ed2.id = c.IdEdicion where ed2.IdProducto = p.id) as cantidadCompras
        FROM producto p
        join tipoproducto tp on tp.Id = p.IdTipoProducto;");
    }

    public function ventas(){
        return $this->database->query("SELECT 
        pr.Nombre as Producto, count(*) AS Cantidad
        FROM producto pr
        JOIN edicion ed ON ed.IdProducto = pr.Id
        JOIN compra co ON co.IdEdicion = ed.Id
        GROUP BY pr.Nombre");
    }
}
