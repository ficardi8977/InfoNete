<?php

class UsuarioController {
    private $usuarioModel;
    private $render;


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
        if($msjError)
        {
            $data["msjError"] = $msjError;
            echo $this->render->render("signinView.mustache",SesionData::cargar($data));
            exit();
        }
        // este metodo genera url y la enviar por mail para confirar usuario
        $this->usuarioModel->crearVerificacion($nombre, $email);
        
        $data["nombre"] = $nombre;
        $data["email"] = $email;
        echo $this->render->render("verificacionUsuarioView.mustache",$data);
    }

    public function confirmar()
    {
        $idUsuario = $_GET["IdUsuario"];
        $codigoVerificador = $_GET["CodigoVerificacion"];
        
        $this->usuarioModel->confirmar($idUsuario, $codigoVerificador);
        
        echo $this->render->render("confirmacionView.mustache");
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
        Permisos::validarAcceso(Rol::Administrador);
        $data["usuarios"]= $this->usuarioModel->getUsuariosConTipo();
        echo $this->render->render("mostrarUsuariosView.mustache", SesionData::cargar($data));

    }

    public function mostrarUsuariosContenidistas(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["usuariosContenidistas"]= $this->usuarioModel->getUsuariosContenidistas();
        $html = $this->render->render("listaContenidistasView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html);
    }

    public function modificar (){
        Permisos::validarAcceso(Rol::Administrador);
        $data['IdUsuario']= $_GET['IdUsuario'];
        $data['tiposUsuarios'] = $this->usuarioModel->tipoDeUsuarios();
         echo $this->render->render("modificarUsuarioView.mustache", SesionData::cargar($data));
    }

    public function modificarUsuario(){
        Permisos::validarAcceso(Rol::Administrador);
        $tipoUsuario = $_POST['IdTipoUsuario'];
        $idUsuario = $_POST ['IdUsuario'];
        $this-> usuarioModel->updateUsuario($tipoUsuario,$idUsuario);
        Redirect::doIt("/usuario/mostrarUsuarios");
    }

    public function baja(){
        Permisos::validarAcceso(Rol::Administrador);
        $IdUsuario = $_POST['Id'];
        $this->usuarioModel->deleteUsuario($IdUsuario);
        Redirect::doIt("/usuario/mostrarUsuarios");
    }

    public function mostrarProductosSuscriptosyComprados(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["usuarios"]= $this->usuarioModel->getUsuariosConTipo();
        $data["productosCompradosPorUsuario"]=$this->usuarioModel->productosCompradosPorUsuario();
        $data["productosSuscriptosPorUsuario"]=$this->usuarioModel->productosSuscriptosPorUsuario();
                $html = $this->render->render("listaCompraYSuscripcionProductosView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html);
    }

    public function mostrarProductosConInfo(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["productos"] = $this->usuarioModel->getProductosConSuTipo();
        $html = $this->render->render("listaProductosConInfo.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html);
    }
}
