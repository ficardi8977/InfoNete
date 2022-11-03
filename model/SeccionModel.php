<?php

class SeccionModel{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function alta($Id,$nombre){

        $sql = "INSERT INTO seccion($Id, $nombre)
        VALUES('".Id."',
               ".$nombre.")";

        $this->database->execute($sql);
        
    }

    public function baja($Id,$nombre){
        $IdSeccion= $_POST["Id"];
        $sql= "DELETE FROM seccion WHERE Id=".$IdSeccion." ";

        $this->database->execute($sql);
    }


}