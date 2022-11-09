<?php
    class Permisos{
    public static function validarAcceso($rolMinimo){
        if(!isset($_SESSION["Logueado"]) || 
           $rolMinimo > $_SESSION["IdTipoUsuario"]){
            Redirect::doIt("/");
        }
    }
}