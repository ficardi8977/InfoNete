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
        // encriptar password a md5($password);
        $sql = "SELECT * FROM usuario where nombre = '" . $nombre ."'and password = '". $password. "'";
        return $this->database->query($sql);
    }
}