<?php
include_once("helpers/Redirect.php");
include_once("helpers/MySQlDatabase.php");
include_once('helpers/MustacheRenderer.php');
include_once('helpers/Logger.php');
include_once('helpers/Router.php');
include_once('helpers/SesionData.php');
include_once('helpers/Mailer.php');
include_once('helpers/Permisos.php');
include_once('helpers/generadorCpdf.php');



// estos son los propios del tp
include_once("model/UsuarioModel.php");
include_once("model/ProductoModel.php");
include_once("model/SuscripcionModel.php");
include_once("model/EdicionModel.php");
include_once("model/NoticiaModel.php");
include_once("model/SeccionModel.php");
include_once("model/EdicionesModel.php");

// enums
include_once("model/enums/Rol.php");



include_once('controller/HomeController.php');
include_once('controller/UsuarioController.php');
include_once('controller/NoticiaController.php');
include_once('controller/SuscripcionController.php');
include_once('controller/EdicionController.php');
include_once('controller/ProductoController.php');
include_once('controller/SeccionController.php');
include_once('controller/EdicionesController.php');

include_once('dependencies/mustache/src/Mustache/Autoloader.php');
include_once ('dependencies/DomPdf/autoload.inc.php');


class Configuration {
    private $database;
    private $view;
    private $mailer;

    public function __construct() {
        $this->database = new MySQlDatabase();
        $this->view = new MustacheRenderer("view/", 'view/partial/');
        $this->mailer = new Mailer();
    }

    // CONFIGS DE CONTROLLER //

    public function getHomeController(){
        return new HomeController($this->createProductoModel(), $this->view);
    }

    public function getUsuarioController(){
        return new UsuarioController($this->createUsuarioModel(), $this->view, $this->getRouter());
    }

    public function getNoticiaController(){
        return new NoticiaController($this->createNoticiaModel(), $this->createProductoModel(), $this->createEdicionModel(), $this->createSeccionModel(), $this->view);
    }

    public function getSuscripcionController(){
        return new SuscripcionController($this->createSuscripcionModel(), $this->view, $this->createProductoModel(), $this->createEdicionModel());
    }
    public function getEdicionController(){
        return new EdicionController($this->createEdicionModel(), $this->createSeccionModel(), $this->view);
    }
    public function getEdicionesController(){
        return new EdicionesController($this->createEdicionesModel(), $this->createProductoModel(), $this->view);
    }
    public function getProductoController(){
        return new ProductoController($this->createProductoModel(),$this->view);
    }

    public function getSeccionController(){
        return new SeccionController($this->createSeccionModel(),$this->view);
    }
    // //
    // CONFIGS DE MODEL //

    private function createUsuarioModel(): UsuarioModel {
        return new UsuarioModel($this->database, $this->mailer);
    }
    private function createProductoModel(): ProductoModel {
        return new ProductoModel($this->database);
    }

    public function getRouter() {
        return new Router($this, "home", "get");
    }

    public function createSuscripcionModel(): SuscripcionModel {
        return new SuscripcionModel($this->database);
    }
    public function createEdicionModel(): EdicionModel {
        return new EdicionModel($this->database);
    }

    public function createEdicionesModel(): EdicionesModel {
        return new EdicionesModel($this->database);
    }

    public function createNoticiaModel() : NoticiaModel {
        return new NoticiaModel($this->database);
    }

    public function createSeccionModel() : SeccionModel {
        return new SeccionModel($this->database);
    }
}