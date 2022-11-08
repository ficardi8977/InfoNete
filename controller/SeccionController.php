<?php
class SeccionController {

    private $seccionModel;
    private $render;
    private $sesion;


    public function __construct($seccionModel, $render, $sesion)
    {
        $this->seccionModel = $seccionModel;
        $this->render = $render;
        $this->sesion = $sesion;
    }

    public function mostrarSecciones(){
        $idSeccion=$_GET["IdSeccion"];
        $data['secciones']= $this->seccionModel->getSecciones();
        echo $this->render->render("mostrarSecciones.mustache", $this->sesion->cargar($data));
    }

}
