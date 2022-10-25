<?php
class SesionData {

    private $logger;

    public function __construct($logger) {
        $this->logger = $logger;
    }

    public function guardar($usuario, $tipoUsuario, $logueado )
    {
        $_SESSION["Nombre"] = $usuario;
        switch ($tipoUsuario) {
            case 1:
                $_SESSION["EsLector"] = true;
                break;
            case 2:
                $_SESSION["EsContedista"] = true;
                break;
            case 3:
                $_SESSION["EsAdministrador"] = true;
                break;
        }
        
        $this->logger->info("guardado de variables de sesión:".$_SESSION["Nombre"]."-".$_SESSION["IdTipoUsuario"]);
        $this->Logueado($logueado);
    }

    public function logueado($logueado)
    {
        $_SESSION["Logueado"] = $logueado;
    }

    public function esLogueado()
    {
        return $_SESSION["Logueado"];
    }

    public function cargar($data = [])
    {
        if($this->esLogueado())
        {
            $data["sesion"] = $_SESSION;
        }
        return $data;
    }
}
?>