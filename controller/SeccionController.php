<?php
class SeccionController
{

    private $seccionModel;
    private $render;
    private $sesion;


    public function __construct($seccionModel, $render, $sesion)
    {
        $this->seccionModel = $seccionModel;
        $this->render = $render;
        $this->sesion = $sesion;
    }

    public function mostrarSecciones()
    {
        $idSeccion = $_GET["IdSeccion"];
        $data['secciones'] = $this->seccionModel->getSecciones();
        echo $this->render->render("mostrarSecciones.mustache", $this->sesion->cargar($data));
    }

    public function alta()
    {
        echo $this->render->render("altaSeccion.mustache", $this->sesion->cargar());

    }

    public function altaSeccion()
    {

        $nombre = $_POST['nombre'];
        $data['secciones'] = $this->seccionModel->altaSeccion($nombre);

        echo Redirect::doIt("/seccion/mostrarSecciones");
    }

    public function baja()
    {
        $this->seccionModel->bajaSeccion($_POST["Id"]);
        Redirect::doIt("/seccion/mostrarSecciones");
    }

    public function modificar()
    {
        $data['IdSeccionAModificar'] = $_GET['Id'];
        $data['seccion'] = $this->seccionModel->getSeccion($_POST['IdSeccion']);

        echo $this->render->render("modificarSeccion.mustache", $this->sesion->cargar($data));
    }


    public function modificarSeccion(){

        $nombreSeccion = $_POST['nombreSeccion'];

        $this->seccionModel->updateSeccion($_POST['Id'], $nombreSeccion);

        echo Redirect::doIt("/seccion/mostrarSeccioes");

    }
}