<?php
class NoticiaController {
    
    private $noticiaModel;
    private $render;

    public function __construct($noticiaModel, $render){

        $this->noticiaModel = $noticiaModel;
        $this->render = $render;
    }

    public function mostrarABMNoticias(){
        Permisos::validarAcceso(Rol::Contenidista);
        echo $this->render->render("abmNoticiasView.mustache", SesionData::cargar());
    }

    public function listarNoticias()
    {
        Permisos::validarAcceso(Rol::Lector);
        if(isset($_GET["edicion"])){
            $edicion = $_GET["edicion"];
            $seccion = $_GET["seccion"];
            $idEdicionSeccion = $this->noticiaModel->getIdEdicionSeccion($edicion, $seccion);
            if(!$idEdicionSeccion)
                $idEdicionSeccion = $this->noticiaModel->asociarSeccion($edicion, $seccion);
        }
        else
            $idEdicionSeccion = $_GET['IdEdicionSeccion'];
        
        if(isset($_GET["errMsg"])){
            $data["errMsg"] = $_GET["errMsg"];

        }
        $data["IdEdicionSeccion"] = $idEdicionSeccion;
        $data["noticias"] = $this->noticiaModel->getNoticias($idEdicionSeccion);
        foreach ($data["noticias"] as $key => $value) {
            if($value['IdEstadoNoticia'] == 3){
                $data["noticias"][$key]["Publicada"] = true;
                $data["HayNoticiasLector"] = true;
            }
        }
        if($data["noticias"])
            $data["HayNoticias"] = true;
        echo $this->render->render("noticiasView.mustache", SesionData::cargar($data));

        // foreach ($data["noticias"] as $key => $value) {
        //     switch ($value['IdEstadoNoticia']) {
        //         case 1:
        //             $data["noticias"][$key]["Borrador"] = true;
        //             break;               
        //         case 2:
        //             $data["noticias"][$key]["A publicar"] = true;
        //             break;
        //         case 3:
        //             $data["noticias"][$key]["Publicada"] = true;
        //             break;
        //         case 4:
        //             $data["noticias"][$key]["Baneada"] = true;
        //             break;
        //     }
        // }
    }

    public function alta()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $data["IdEdicionSeccion"] = $_POST["IdEdicionSeccion"];
        echo $this->render->render("crearNoticiaView.mustache", SesionData::cargar($data));
    }

    public function cargar()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $datos = $this->recibirDatosNoticia();        
        $this->noticiaModel->addNoticia($datos);
        echo Redirect::doIt("/noticia/listarNoticias?IdEdicionSeccion=".$datos["idEdicionSeccion"]."");
    }

    public function actualizar()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $datos = $this->recibirDatosNoticia();
        $datos["id"] = $_POST["idNoticia"];
        $this->noticiaModel->updateNoticia($datos);
        echo Redirect::doIt("/noticia/listarNoticias?IdEdicionSeccion=".$datos["idEdicionSeccion"]."");;
    }

    public function baja()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $idNoticia = $_POST["datos"];
        if($this->noticiaModel->verificarEstadoNoticia($idNoticia) == 1){
            $this->noticiaModel->bajaNoticia($idNoticia);
            echo "Noticia eliminada";
        }
    }

    //publicar noticia esperando aprobacion
    public function presentar()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $idNoticia = $_POST["datos"];
        if($this->noticiaModel->verificarEstadoNoticia($idNoticia) == 1){
            $this->noticiaModel->presentarNoticia($idNoticia);
            echo "Noticia presentada, esperando aprobacion";
        }
    }

    //aprobar la noticia
    public function aprobar()
    {
        Permisos::validarAcceso(Rol::Editor);
        $idNoticia = $_POST["datos"];
        if($this->noticiaModel->verificarEstadoNoticia($idNoticia) == 2){
            $this->noticiaModel->aprobarNoticia($idNoticia);
            echo "Noticia aprobada y publicada";
        }
    }

    //banear noticia
    public function banear()
    {
        Permisos::validarAcceso(Rol::Editor);
        $idNoticia = $_POST["datos"];
        $estado = $this->noticiaModel->verificarEstadoNoticia($idNoticia);
        if($estado == 2 || $estado == 3){
            $this->noticiaModel->banearNoticia($idNoticia);
            echo "Noticia baneada";
        }
    }

    //desbanear noticia
    public function desbanear()
    {
        Permisos::validarAcceso(Rol::Administrador);
        $idNoticia = $_POST["datos"];
        if($this->noticiaModel->verificarEstadoNoticia($idNoticia) == 4){
            $this->noticiaModel->desbanearNoticia($idNoticia);
            echo "Noticia desbaneada";
        }
    }

    public function modificar()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $idNoticia = $_POST["modificar"];
        $idEdicionSeccion = $_POST["IdEdicionSeccion"];
        if($this->noticiaModel->verificarEstadoNoticia($idNoticia) == 1){
            $data = $this->noticiaModel->getNoticia($idNoticia);
            echo $this->render->render("modificarNoticiaView.mustache", SesionData::cargar($data));
        }
        else{
            $errMsg = "La noticia no está en borrador o es inexistente";
            Redirect::doIt("/noticia/listarNoticias&IdEdicionSeccion=$idEdicionSeccion&errMsg=$errMsg");
        }
    }

    public function leer()
    {
        Permisos::validarAcceso(Rol::Lector);
        $idNoticia = $_POST["idNoticia"];
        if($this->noticiaModel->verificarEstadoNoticia($idNoticia) != 1){
            $data = $this->noticiaModel->getNoticia($idNoticia);
            echo $this->render->render("leerNoticiaView.mustache", SesionData::cargar($data));
        }
        else
            Redirect::doIt();
    }

    public function recibirDatosNoticia()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $datos = array (
            "titulo" => $_POST["titulo"],
            "cuerpo" => $_POST["cuerpo"],
            "subtitulo" => $_POST["subtitulo"],
            "idEdicionSeccion" => $_POST["IdEdicionSeccion"],
            "coordenadasX" => $_POST["coordenadasX"],
            "coordenadasY" => $_POST["coordenadasY"]
        );

        //recibo imagen
        if (!empty($_FILES["imagen"]["name"])) {
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/" . $_FILES["imagen"]["name"]);
            $datos["imagen"] = $_FILES["imagen"]["name"];
            $datos["idImagen"] = $_POST["idImagen"];
        }

        //recibo link opcional
        if(!empty($_POST["link"]))
            $datos["link"] = $_POST["link"];

        //recibo imagen o video opcional
        if (!empty($_FILES["foto_o_video"]["name"])) {
            move_uploaded_file($_FILES["foto_o_video"]["tmp_name"], "public/" . $_FILES["foto_o_video"]["name"]);
            $datos["foto_o_video"] = $_FILES["foto_o_video"]["name"];
            $datos["idFoV"] = $_POST["idFoV"];
        }

        //recibo audio opcional
        if(!empty($_FILES["grabacion"]["name"])){
            $grabacionName = uniqid("grabacion", true) . '.wav';
            move_uploaded_file($_FILES["grabacion"]["tmp_name"], "public/" . $grabacionName);
            $datos["grabacion"] = $grabacionName;
            $datos["idGrabacion"] = $_POST["idGrabacion"];
        }
        return $datos;
    }

    public function buscar()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $data["HayNoticias"] = true;
        if(isset($_GET["busqueda"])){
            $data["noticias"] = $this->noticiaModel->buscarNoticia($_GET["busqueda"]);
            echo $this->render->render("noticiasView.mustache", SesionData::cargar($data));
        }
        else{
            $data["noticias"] = $this->noticiaModel->buscarNoticia($_GET["datos"]);
            if($data["noticias"])
                echo $this->render->render("partial/tablaNoticias.mustache", SesionData::cargar($data));
        }
    }
}
