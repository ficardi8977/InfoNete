<?php
class NoticiaController {
    
    private $noticiaModel;
    private $render;
    private $sesion;

    public function __construct($noticiaModel, $render){

        $this->noticiaModel = $noticiaModel;
        $this->render = $render;
    }

    public function mostrarNoticias(){

        $data["noticias"]=$this->noticiaModel->getNoticias(); 
        echo $this->render->render("noticiasView.mustache", SesionData::cargar($data));
    }   

    public function alta()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        echo $this->render->render("noticiaView.mustache", SesionData::cargar());
    }

    public function publicar()
    {
        move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/" . $_FILES["imagen"]["name"]);
        $datos = array (
            "titulo" => $_POST["titulo"],
            "cuerpo" => $_POST["cuerpo"],
            "subtitulo" => $_POST["subtitulo"],
            "imagen" => $_FILES["imagen"]["name"]
        );

        //recibo link opcional
        if(!empty($_POST["link"]))
            $datos["link"] = $_POST["link"];

        //recibo imagen opcional
        if(!empty($_FILES["foto_o_video"]["name"])){
            move_uploaded_file($_FILES["foto_o_video"]["tmp_name"], "public/" . $_FILES["foto_o_video"]["name"]);
            $datos["foto_o_video"] = $_FILES["foto_o_video"]["name"];
        }

        //recibo audio opcional
        if(!empty($_FILES["grabacion"]["name"])){
            $grabacionName = uniqid("grabacion", true) . '.wav';
            move_uploaded_file($_FILES["grabacion"]["tmp_name"], "public/" . $grabacionName);
            $datos["grabacion"] = $grabacionName;
        }
        
        $this->noticiaModel->addNoticia($datos);
        echo Redirect::doIt("/noticia/mostrarNoticias");
    }
}
