<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuarios(){
        return $this->database->query("SELECT * FROM usuario");
    }

    public function getUsuario($nombre, $password){
        //$passMd5 = md5($password);
        $sql = "SELECT * FROM usuario where nombre = '" . $nombre ."'and password = '". $password. "'";
        return $this->database->query($sql);
    }

    public function setUsuario($nombre, $password){
        $sql = "INSERT INTO usuario (nombre, password, IdTipoUsuario, Email, ValidacionMail, UbicacionGeografica)
        VALUES ('$nombre', $password, 1, 'a@a', 0, 'Las toninas')";
        return ($this->database->execute($sql));
    }
}