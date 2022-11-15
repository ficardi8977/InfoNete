<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuarios()
    {
        return $this->database->query("SELECT * FROM usuario");
    }

        public function getUsuariosContenidistas()
    {
        return $this->database->query("SELECT * FROM usuario where IdTipoUsuario= 2");
    }

    public function getUsuariosConTipo() {
        return $this->database->query ("SELECT u.Nombre, u.IdTipoUsuario, u.Id as IdUsuario ,tu.Nombre as TipoUsuario, u.Email , u.CoordenadasX,u.CoordenadasY
        from usuario u inner join tipousuario tu on (u.IdTipoUsuario = tu.id)");
    }

    public function tipoDeUsuarios(){
        return $this->database->query("SELECT* from tipousuario");
    }

    public function getUsuario($nombre, $password)
    {
        $passMd5 = $this->EncriptarClave($password);
        $sql = "SELECT * 
                FROM usuario u 
                join contraseña c on c.idUsuario = u.id   
                where 
                u.nombre = '" . $nombre . "'and c.clave = '" . $passMd5 . "' and validado = true";
        return $this->database->query($sql);
    }

    public function AddUsuario($nombre, $password, $email, $coordenadasX, $coordenadasY,$idTipoDeUsuario = 1)
    {
        $existeUsuario = $this->esUsuarioExistente($nombre);
        if(isset($existeUsuario[0]["existe"]) && $existeUsuario[0]["existe"] == 1){
            return "El usuario ". $nombre ." ya existe.";
        }

        $sql = "INSERT INTO usuario (nombre, IdTipoUsuario, Email,coordenadasX, coordenadasY)
    VALUES ('" . $nombre . "',
            ". $idTipoDeUsuario .",
            '" . $email . "', 
            '" . $coordenadasX . "', 
            '" . $coordenadasY . "')";

        $id = $this->database->execute($sql);

        $this->AddClave($id, $password);
    }
    
    private function esUsuarioExistente($nombreUsuario)
    {
        return $this->database->query("SELECT 1 as existe FROM usuario where Nombre ='".$nombreUsuario."'");
    }

    private function AddClave( $idUsuario, $clave)
    {
        $codigoVerificacion = random_int(100000, 999999);
        $today = date('Y-m-d');
        $fechaExpiracionCodigo = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        $fechaVencimiento = date('Y-m-d', strtotime('+1 year', strtotime($today)));
        $validado = false;

        $sql = "INSERT INTO contraseña (IdUsuario, Clave, CodigoValidador, FechaExpiracionCodigo, FechaVencimiento, Validado)
        VALUES (" . $idUsuario . ",
                '" . $this->EncriptarClave($clave) . "', 
                '" . $codigoVerificacion . "',
                '" . $fechaExpiracionCodigo . "', 
                '" . $fechaVencimiento . "', 
                '" . $validado . "')";

        $this->database->execute($sql);
    }

    private function EncriptarClave($clave)
    {
        return md5($clave);
    }
     


    public function updateUsuario($tipoUsuario,$idUsuario){
        $sql =  ("UPDATE usuario set idTipoUsuario = $tipoUsuario where id = $idUsuario");
        $this->database->execute($sql);
    }

    public function deleteUsuario($IdUsuario){
        $sql = ("DELETE FROM usuario WHERE Id =$IdUsuario");
        $this->database->execute($sql);
    }
}
