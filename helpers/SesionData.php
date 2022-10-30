<?php
class SesionData {

    private $logger;

    public function __construct($logger) {
        $this->logger = $logger;
    }

    public function guardar($usuario, $tipoUsuario, $logueado ,$idUsuario)
    {
        $_SESSION["Nombre"] = $usuario;
        switch ($tipoUsuario) {
            case 1:
                $_SESSION["EsLector"] = true;
                break;
            case 2:
                $_SESSION["EsLector"] = true;
                $_SESSION["EsContenidista"] = true;
                break;
            case 3:
                $_SESSION["EsLector"] = true;
                $_SESSION["EsContenidista"] = true;
                $_SESSION["EsAdministrador"] = true;
                break;
        }
        
        $this->logger->info("guardado de variables de sesión:".$_SESSION["Nombre"]."-".$_SESSION["IdTipoUsuario"]);
        $_SESSION["IdUsuario"]=$idUsuario;
        $this->logueado($logueado);
    }

    public function logueado($logueado)
    {
        $_SESSION["Logueado"] = $logueado;
        $_SESSION["Intentos"] = !$logueado;
    }

    public function esLogueado()
    {
        return isset($_SESSION["Logueado"]) && $_SESSION["Logueado"];
    }
    public function hayIntentos()
    {
        return isset($_SESSION["Intentos"]) && $_SESSION["Intentos"];
    }

    public function cargar($data = [])
    {
        if($this->esLogueado())
        {
            $data["sesion"] = $_SESSION;
        }
        if($this->hayIntentos())
        {
            $data["msjLogError"] = "Usuario o contraseña incorrecto.";
        }
        return $data;
    }
}
?>