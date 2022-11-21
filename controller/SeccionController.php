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
        Permisos::validarAcceso(Rol::Contenidista);
        $data['secciones'] = $this->seccionModel->getSecciones();
        echo $this->render->render("mostrarSecciones.mustache", SesionData::cargar($data));
    }

    public function alta()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        echo $this->render->render("altaSeccion.mustache", SesionData::cargar());

    }

    public function altaSeccion()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $nombre = $_POST['nombre'];
        $data['secciones'] = $this->seccionModel->altaSeccion($nombre);

        echo Redirect::doIt("/seccion/mostrarSecciones");
    }

    public function baja()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $this->seccionModel->bajaSeccion($_POST["Id"]);
        Redirect::doIt("/seccion/mostrarSecciones");
    }

    public function modificar()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        //$data['IdSeccionAModificar'] = $_GET['Id'];
        $data['seccion'] = $this->seccionModel->getSeccion($_POST['Id']);

        echo $this->render->render("modificarSeccion.mustache", SesionData::cargar($data));
    }


    public function modificarSeccion(){
        Permisos::validarAcceso(Rol::Contenidista);
        $this->seccionModel->updateSeccion($_POST['IdSeccion'], $_POST['nombreSeccion']);

        echo Redirect::doIt("/seccion/mostrarSecciones");

    }

    public function listarSeccionesAjax()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $edicion = $_POST['datos'];
        $data = $this->seccionModel->getSeccionesPorEdicion($edicion);
        echo "<select id='secciones' name='seccion' class='form-select'>";
        echo "<option value='default'>Seleccione una seccion</option>";
        foreach ($data["secciones"] as $value) {
            echo "<option value='" . $value['Id'] . "'>" . $value['Nombre'] . "</option>";
        }
        foreach ($data["seccionesACrear"] as $value) {
            echo "<option value='" . $value['Id'] . "'>" . $value['Nombre'] . " - Asociar Seccion</option>";
        }
        echo "</select>";
    }
}