<?php

class UsuarioController {
    private $usuarioModel;
    private $render;
    private $sesion;

    public function __construct($usuarioModel, $render){
        $this->usuarioModel = $usuarioModel;
        $this->render = $render;
    }
  
    public function alta(){

        echo $this->render->render("signinView.mustache", SesionData::cargar());
    }

    public function registrar()
    {
        $nombre = $_POST["nombre"];
        $password = $_POST["contraseña"];
        $email = $_POST["email"];
        $coordenadasX = $_POST["coordenadasX"];
        $coordenadasY = $_POST["coordenadasY"];
        

        $msjError= $this->usuarioModel->addUsuario($nombre, $password,$email,$coordenadasX,$coordenadasY);

        $data["nombre"] = $nombre;
        $data["email"] = $email;
        if($msjError)
        {
            $data["msjError"] = $msjError;
            echo $this->render->render("signinView.mustache",SesionData::cargar($data));
            exit();
        }
        echo $this->render->render("verificacionUsuarioView.mustache",$data);
    }

    public function confirmar()
    {
        echo $this->render->render("verificacionUsuarioView.mustache");
    }

    public function login()
    {
        $nombre = $_POST["nombre"];
        $password = $_POST["password"];

        $result = $this->usuarioModel->getUsuario($nombre, $password); 
        
        if(isset($result[0]))
        {
            SesionData::guardar($result[0]["Nombre"], $result[0]["IdTipoUsuario"], 
                                   true, 
                                   $result[0]["Id"]);
        }else
        {
            SesionData::logueado(false);
        }
        Redirect::doIt();
    }

    public function close()
    {
        session_destroy();
        Redirect::doIt();
    }


    public function mostrarUsuarios(){
        $data["usuarios"]= $this->usuarioModel->getUsuariosConTipo();
        echo $this->render->render("mostrarUsuariosView.mustache", SesionData::cargar($data));

    }

    public function mostrarUsuariosContenidistas(){
        $data["usuariosContenidistas"]= $this->usuarioModel->getUsuariosContenidistas();
        $html = $this->render->htmlToVariable("listaContenidistasView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html);
    }

    public function modificar (){
        $data['IdUsuario']= $_GET['IdUsuario'];
        $data['tiposUsuarios'] = $this->usuarioModel->tipoDeUsuarios();
         echo $this->render->render("modificarUsuarioView.mustache", SesionData::cargar($data));
    }

    public function modificarUsuario(){
        $tipoUsuario = $_POST['IdTipoUsuario'];
        $idUsuario = $_POST ['IdUsuario'];
        $this-> usuarioModel->updateUsuario($tipoUsuario,$idUsuario);
        Redirect::doIt("/usuario/mostrarUsuarios");
    }

    public function baja(){
        $IdUsuario = $_POST['Id'];
        $this->usuarioModel->deleteUsuario($IdUsuario);
        Redirect::doIt("/usuario/mostrarUsuarios");
    }
}
?>