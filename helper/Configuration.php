<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");

include_once("controller/LoginController.php");
include_once("controller/SigninController.php");

include_once("model/UsuarioModel.php");


include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");

class Configuration{
    public function getPresentacionModel(){
        $database = $this->getDatabase();
        return new TourModel($database);
    }

    private function getDatabase(){
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    public function getUsuarioModel()
    {
        $database = $this->getDatabase();
        return new UsuarioModel($database);
    }

    public function getLoginController()
    {
        $model = $this-> getUsuarioModel();
        $render = $this->getRender();
        return new LoginController($model, $render);
    }

    public function getSigninController()
    {
        $model = $this->getUsuarioModel();
        $render = $this->getRender();
        return new SigninController($model, $render);
    }

    private function getConfig(){
        return parse_ini_file("config/config.ini");
    }

    public function getRender(){
        return new Render('view/partial');
    }

    public function getRouter(){
        return new Router($this);
    }

    public function getUrlHelper(){
        return new UrlHelper();
    }
}