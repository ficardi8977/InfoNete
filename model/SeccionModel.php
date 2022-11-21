<?php

class SeccionModel{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getSecciones(){
        return $this->database->query("SELECT * FROM seccion");
    }

    public function getSeccionesPorEdicion($edicion)
    {
        $sql = "SELECT s.Id, s.Nombre FROM seccion s JOIN edicionseccion e ON s.id = e.idSeccion WHERE e.idEdicion = $edicion";
        $data["secciones"] = $this->database->query($sql);
        $sql = "SELECT Id, Nombre FROM seccion
        WHERE Id NOT IN (SELECT s.Id FROM edicionseccion e JOIN seccion s ON s.id = e.idSeccion WHERE e.idEdicion = $edicion)";
        $data["seccionesACrear"] = $this->database->query($sql);
        return $data;
    }

    public function getSeccion($idSeccion){
        return $this->database->query("SELECT * FROM seccion WHERE  Id = $idSeccion;");
    }

    public function altaSeccion($nombre){

       $sql=("INSERT INTO seccion(nombre) VALUES ('".$nombre."')");
       $this->database->execute($sql);
        
    }

    public function bajaSeccion($idSeccion){
        $sql = ("DELETE from seccion where Id =".$idSeccion.";");
        $this->database->execute($sql);
    }


    public function updateSeccion($idSeccion,$nombreSeccion){
        $sql=("UPDATE seccion SET Nombre='$nombreSeccion' WHERE Id=$idSeccion");
        $this->database->execute($sql);
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