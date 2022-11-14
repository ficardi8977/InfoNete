<?php
class SeccionController
{

    private $seccionModel;
    private $render;


    public function __construct($seccionModel, $render)
    {
        $this->seccionModel = $seccionModel;
        $this->render = $render;
    }

    public function mostrarSecciones()
    {
        $data['secciones'] = $this->seccionModel->getSecciones();
        echo $this->render->render("mostrarSecciones.mustache", SesionData::cargar($data));
    }

    public function alta()
    {
        echo $this->render->render("altaSeccion.mustache", SesionData::cargar());

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
        //$data['IdSeccionAModificar'] = $_GET['Id'];
        $data['seccion'] = $this->seccionModel->getSeccion($_POST['Id']);

        echo $this->render->render("modificarSeccion.mustache", SesionData::cargar($data));
    }


    public function modificarSeccion(){
        $this->seccionModel->updateSeccion($_POST['IdSeccion'], $_POST['nombreSeccion']);

        echo Redirect::doIt("/seccion/mostrarSecciones");

    }
}