<?php
class SesionData {

    public static function guardar($usuario, $tipoUsuario, $logueado ,$idUsuario)
    {
        $_SESSION["Nombre"] = $usuario;
        switch ($tipoUsuario) {
            case 1:
                $_SESSION["EsLector"] = true;
                $_SESSION["SoloLector"] = true;
                break;
            case 2:
                $_SESSION["EsLector"] = true;
                $_SESSION["EsContenidista"] = true;
                $_SESSION["SoloContenidista"] = true;
                break;
            case 3:
                $_SESSION["EsLector"] = true;
                $_SESSION["EsContenidista"] = true;
                $_SESSION["EsEditor"] = true;
                $_SESSION["SoloEditor"] = true;
                break;
            case 4:
                $_SESSION["EsLector"] = true;
                $_SESSION["EsContenidista"] = true;
                $_SESSION["EsEditor"] = true;
                $_SESSION["EsAdministrador"] = true;
                break;
        }
        $_SESSION["IdTipoUsuario"]=$tipoUsuario;
        $_SESSION["IdUsuario"]=$idUsuario;
        SesionData::logueado($logueado);
    }

    public static function logueado($logueado)
    {
        $_SESSION["Logueado"] = $logueado;
        $_SESSION["Intentos"] = !$logueado;
    }

    public static function esLogueado()
    {
        return isset($_SESSION["Logueado"]) && $_SESSION["Logueado"];
    }
    public static function hayIntentos()
    {
        return isset($_SESSION["Intentos"]) && $_SESSION["Intentos"];
    }

    public static function cargar($data = [])
    {
        if(SesionData::esLogueado())
        {
            $data["sesion"] = $_SESSION;
        }
        if(SesionData::hayIntentos())
        {
            $data["msjLogError"] = "Usuario o contraseña incorrecto.";
        }
        return $data;
    }
}
?>