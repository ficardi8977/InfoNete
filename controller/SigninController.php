<?php
    class SigninController
    {
        private $usuarioModel;
        private $render;
        
        public function __construct($usuarioModel, $render){
            $this->usuarioModel = $usuarioModel;
            $this->render = $render;
        }
        
        public function procesarSignin()
        {
            echo "hola";
            $nombre = $_POST["nombre"];
            $password = $_POST["password"];

            $resultado = $this->usuarioModel->setUsuario($nombre, $password);
            if($resultado){
                echo $this->render->render("view/loginView.php");
            }
            else{
                echo "Usuario existente";
            }
        }

        public function execute()
    {
        echo $this->render->render("view/signinView.php");
    }
    }
    