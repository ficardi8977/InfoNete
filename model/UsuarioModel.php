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
    private function getIdUsuario($nombre){
        return $this->database->query("SELECT Id FROM usuario where nombre ='".$nombre."'");
    }

    public function getUsuario($nombre, $password){
        $passMd5 = $this->EncriptarClave($password);
        $sql = "SELECT * 
                FROM usuario u 
                join contraseña c on c.idUsuario = u.id   
                where 
                u.nombre = '" . $nombre ."'and c.clave = '".$passMd5. "' and validado = true";
        return $this->database->query($sql);
    }

    public function AddUsuario($nombre, $password,$email,$coordenadasX,$coordenadasY){

    // insertar usuario.
    $sql = "INSERT INTO usuario (nombre, IdTipoUsuario, Email,coordenadasX, coordenadasY)
    VALUES ('".$nombre."',
            1, 
            '".$email."', 
            '".$coordenadasX."', 
            '".$coordenadasY."')";
                 
    $this->database->execute($sql);


    return $this->AddClave($nombre, $password);

    }

    private function AddClave($nombre, $clave)
    {
        // obtener idUsuario cargado para insertar su registro contraseña
        $resultIdUsuario = $this-> getIdUsuario($nombre);

        //seteo de variable
        $idUsuario = $resultIdUsuario[0]["Id"];
        $codigoVerificacion = random_int(100000, 999999);
        $today =date('Y-m-d');
        $fechaExpiracionCodigo=date('Y-m-d', strtotime('+1 day', strtotime($today)));
        $fechaVencimiento=date('Y-m-d', strtotime('+1 year', strtotime($today)));
        $validado = false;
        
        $sql = "INSERT INTO contraseña (IdUsuario, Clave, CodigoValidador, FechaExpiracionCodigo, FechaVencimiento, Validado)
        VALUES (".$idUsuario.",
                '".$this->EncriptarClave($clave)."', 
                '".$codigoVerificacion."',
                '".$fechaExpiracionCodigo."', 
                '".$fechaVencimiento."', 
                '".$validado."')";

        $this->database->execute($sql);
    }

    private function EncriptarClave($clave)
    {
        return md5($clave);
    }
}