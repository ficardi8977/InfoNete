<?php

class EdicionController {
    private $edicionModel;
    private $seccionModel;
    private $render;

    public function __construct($edicionModel, $seccionModel, $render){

        $this->edicionModel = $edicionModel;
        $this->seccionModel = $seccionModel;
        $this->render = $render;
    }

    public function listar()
    {
        Permisos::validarAcceso(Rol::Lector);
        $data["ediciones"] = $this->edicionModel->getEdicionesDeProducto($_GET["IdProducto"]);
        echo $this->render->render("compraEdicionView.mustache", SesionData::cargar($data));
    }

    public function comprar()
    {
        Permisos::validarAcceso(Rol::Lector);   
        $this->edicionModel->comprar($_POST["IdEdicion"], $_POST["Precio"] );
        echo Redirect::doIt("/edicion/listar?IdProducto=".$_POST["IdProducto"]);
    }

    public function misCompras()
    {
        Permisos::validarAcceso(Rol::Lector);   
        $data['compras']= $this->edicionModel->listCompras();
        echo $this->render->render("misComprasView.mustache", SesionData::cargar($data));
    }

    public function detalle()
    {        
        $data['IdEdicion'] =$_GET["IdEdicion"];
        $data['edicion'] = $this->edicionModel->listSecciones($_GET["IdEdicion"]);
        echo $this->render->render("detalleEdicionView.mustache", SesionData::cargar($data));
    }
    
    public function MostrarAsociarSeccion()
    {        
        $data['IdEdicion'] =$_GET["IdEdicion"];
        $data['secciones'] = $this->seccionModel->listarDisponibles($_GET["IdEdicion"]);   
        echo $this->render->render("asociarSeccionView.mustache", SesionData::cargar($data));
    }

    public function asociarSeccion()
    {        
        $this->edicionModel->asociarSeccion($_POST["IdEdicion"], $_POST["IdSeccion"] );
        Redirect::doIt("/edicion/detalle?IdEdicion=".$_POST["IdEdicion"]);   
    }
    
    public function desasociarSeccion()
    {        
        $this->edicionModel->desasociarSeccion($_POST["IdEdicion"], $_POST["IdSeccion"] );
        Redirect::doIt("/edicion/detalle?IdEdicion=".$_POST["IdEdicion"]);   
    }

    public function listarEdicionesAjax()
    {
        Permisos::validarAcceso(Rol::Contenidista);
        $producto = $_POST['datos'];
        $data = $this->edicionModel->getEdicionesPorProducto($producto);
        echo "<select id='ediciones' name='edicion' class='form-select'>";
        echo "<option value='default'>Seleccione una edicion</option>";
        foreach ($data as $value) {
            echo "<option value='" . $value['Id'] . "'>Edicion Número " . $value['Numero'] . "</option>";
        }
        echo "</select>";
    }
}
?>
