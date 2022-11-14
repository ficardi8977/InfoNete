<?php

class SeccionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function listarDisponibles($idEdicion)
    {
        return $this->database->query("SELECT s.Id, s.Nombre 
        from seccion s
        where not exists(
            select * 
            from edicionSeccion es 
            where es.idSeccion = s.id 
            and es.IdEdicion= ".$idEdicion.")"); 
    }

}