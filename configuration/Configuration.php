<?php
include_once ("helpers/Redirect.php");
include_once('helpers/MySQlDatabase.php');
include_once('helpers/MustacheRenderer.php');
include_once('helpers/Logger.php');
include_once('helpers/Router.php');



// estos son los propios del tp
include_once ("model/UsuarioModel.php");

include_once('controller/HomeController.php');
include_once('controller/UsuarioController.php');


include_once ('dependencies/mustache/src/Mustache/Autoloader.php');

class Configuration {
    private $database;
    private $view;

    public function __construct() {
        $this->database = new MySQlDatabase();
        $this->view = new MustacheRenderer("view/", 'view/partial/');
    }

    // CONFIGS DE CONTROLLER //

    public function getHomeController(){
        return new HomeController($this->createUsuarioModel(), $this->view);
    }

    public function getUsuarioController(){
        return new UsuarioController($this->createUsuarioModel(), $this->view);
    }

    // //
    // CONFIGS DE MODEL //

    private function createUsuarioModel(): UsuarioModel {
        return new UsuarioModel($this->database);
    }

    public function getRouter() {
        return new Router($this, "home", "get");
    }

    //
}