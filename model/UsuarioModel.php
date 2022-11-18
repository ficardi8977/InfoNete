<?php

class UsuarioModel
{
    private $database;
    private $mailer;

    public function __construct($database, $mailer)
    {
        $this->database = $database;
        $this->mailer = $mailer;
    }

    public function getUsuarios()
    {
        return $this->database->query("SELECT * FROM usuario");
    }

        public function getUsuariosContenidistas()
    {
        return $this->database->query("SELECT u.Nombre,u.CoordenadasY, u.CoordenadasX, tu.Nombre as TipoUsuario , u.Email FROM usuario  u inner join tipoUsuario  tu  on ( u.IdTipoUsuario = tu.Id) where IdTipoUsuario= 2");
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

    public function crearVerificacion($nombre, $email)
    {
        $usuario = $this->database->query("SELECT u.id as IdUsuario, c.CodigoValidador  
                                FROM usuario u 
                                JOIN contraseña c on c.idUsuario = u.id
                                where u.nombre ='". $nombre."' AND 
                                u.email = '".$email."';");

        $urlConfirmacion = $this->crearUrlConfirmacion($usuario[0]["IdUsuario"], $usuario[0]["CodigoValidador"]);
        $this->mailer->enviar($nombre, $email, $urlConfirmacion);
    }

    public function confirmar($idUsuario, $codigoVerificacion)
    {
        $fechaHoy = date('Y-m-d');
        return $this->database->execute("UPDATE contraseña
        SET CodigoValidador=null,  
        fechaExpiracionCodigo = null,
        Validado = true
        where idUsuario = $idUsuario AND codigoValidador = '".$codigoVerificacion."' AND fechaExpiracionCodigo > '".$fechaHoy."'");
    }

    private function crearUrlConfirmacion($idUsuario, $codigoVerificacion)
    {
        return "http://localhost/usuario/confirmar?IdUsuario=$idUsuario&CodigoVerificacion=$codigoVerificacion";
    }

    public function productosCompradosPorUsuario(){
        $sql= ("select u.Nombre as NombreUsuario,tu.Nombre as TipoUsuario,e.Id  as NumeroEdicion,p.Nombre as Producto,
            CASE
            when c.Pagado = true then 'pagado'
            else 'impago'
            end as EstadoCompra
            from compra c inner join edicion e on(c.IdEdicion=e.Id)
            inner join producto p on ( e.IdProducto=p.Id)
            inner join usuario u on(u.Id=c.IdUsuario)
            inner join tipousuario tu on(u.IdTipoUsuario=tu.Id)
            order by u.Nombre");
            return $this->database->query($sql);
    }

    public function  productosSuscriptosPorUsuario(){
        $sql=("select tu.Nombre as NombreUsuario,p.Nombre as TipoProducto, s.FechaDesde,s.FechaHasta
        from suscripcion s 
        inner join usuario u on ( s.IdUsuario = u.Id)
        inner join tipousuario tu on (u.IdTipoUsuario= tu.Id)
        inner join producto p on (s.IdProducto= p.Id)
        order by u.Nombre");
        return $this->database->query($sql);
    }

    public function getProductosConSuTipo(){
        $sql = ("SELECT p.Id as Id, p.nombre as Nombre , p.Imagen as Imagen, p.Mensualidad as Mensualidad,  t.nombre as NombreTipoProducto
        from producto p inner join tipoproducto t on (p.IdTipoProducto=t.Id)");
        return $this->database->query($sql);
    }
}
