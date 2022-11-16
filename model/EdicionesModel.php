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