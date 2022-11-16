<?php
class NoticiaController {
    
    private $noticiaModel;
    private $productoModel;
    private $edicionModel;
    private $seccionModel;
    private $render;
    private $sesion;

    public function __construct($noticiaModel, $productoModel, $edicionModel, $seccionModel, $render){

        $this->noticiaModel = $noticiaModel;
        $this->productoModel = $productoModel;
        $this->edicionModel = $edicionModel;
        $this->seccionModel = $seccionModel;
        $this->render = $render;
    }

    public function mostrarABMNoticias(){
        Permisos::validarAcceso(Rol::Contenidista);
        $data["productos"] = $this->productoModel->getProductos();
        echo $this->render->render("noticiasView.mustache", SesionData::cargar($data));
        
    }

    public function listarNoticias()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $edicion = $_POST['datos']['edicion'];
        $seccion = $_POST['datos']['seccion'];
        $data["noticias"] = $this->noticiaModel->getNoticias($edicion, $seccion);
        echo $this->render->render("listarNoticias.mustache", SesionData::cargar($data));
        }

    public function alta()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        echo $this->render->render("noticiaView.mustache", SesionData::cargar());
    }

    public function publicar()
    {
        Permisos::validarAcceso(Rol::Contenidista);
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
    
    public function listarEdicionesPorProducto()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $producto = $_POST['datos'];
        $data = $this->edicionModel->getEdicionesPorProducto($producto);
        echo "<select id='ediciones' name='ediciones' class='form-select'>";
        echo "<option value='default'>Seleccione una edicion</option>";
        foreach ($data as $value) {
            echo "<option value='" . $value['Id'] . "'>" . $value['Numero'] . "</option>";
        }
        echo "</select>";
    }

    public function listarSeccionesPorEdicion()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $edicion = $_POST['datos'];
        $data = $this->seccionModel->getSeccionesPorEdicion($edicion);
        echo "<select id='secciones' name='secciones' class='form-select'>";
        echo "<option value='default'>Seleccione una seccion</option>";
        foreach ($data as $value) {
            echo "<option value='" . $value['Id'] . "'>" . $value['Nombre'] . "</option>";
        }
        echo "</select>";
    }
}
