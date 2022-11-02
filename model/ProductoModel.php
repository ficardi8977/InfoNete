<?php

class ProductoModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function getproductos()
    {
        return $this->database->query("SELECT * FROM producto");
    }

     public function getproducto($idProducto)
    {
        return $this->database->query("SELECT * FROM producto WHERE id= ".$idProducto.";");
    }

}