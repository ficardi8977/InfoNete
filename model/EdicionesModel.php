<?php

class EdicionesModel{

    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function altaEdicion($numero, $idProducto, $fecha, $precio){
        $sql = ("INSERT INTO edicion(Numero, IdProducto, Fecha, precio) VALUES ('$numero', '$idProducto', '$fecha', $precio)");
        $this->database->execute($sql);
    }
}