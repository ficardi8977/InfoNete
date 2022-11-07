<?php
    class Permisos{
    public static function validar($rolMinimo="Lector"){
        if(!isset($_SESSION["logueado"]))
        {
            Redirect::doIt("/");
        }
    }
}