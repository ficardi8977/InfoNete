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