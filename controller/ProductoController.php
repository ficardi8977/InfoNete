<?php
class ProductoController {
    private $productoModel;
     private $render;

    public function __construct($productoModel,$render){
        $this->productoModel=$productoModel;
        $this->render=$render;
        }

    public function mostrarProductos(){
           Permisos::validarAcceso(Rol::Contenidista);
           $data['productos']=$this->productoModel->getProductosConSuTipo(); 
           echo $this->render->render("productosView.mustache", SesionData::cargar($data));
    }   

    public function baja(){  
            Permisos::validarAcceso(Rol::Contenidista);
             $this->productoModel->bajaProducto($_POST["Id"]);
             Redirect::doIt("/producto/mostrarProductos");
    }


    public function alta(){
        Permisos::validarAcceso(Rol::Contenidista);
        echo $this->render->render("altaProductoView.mustache", SesionData::cargar());
    }

    public function altaProducto(){
            Permisos::validarAcceso(Rol::Contenidista);
            $nombreProducto = $_POST['nombreProducto'];
            $tipoProducto = isset($_POST['tipoProducto']);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/" . $_FILES["imagen"]["name"]);  //tmp_name ruta donde guarda el apache el archivo
            $imagen = $_FILES["imagen"]["name"];  // Para obtener solo el nombre de la imagen
        
            $this->productoModel->altaProducto($nombreProducto,$tipoProducto,$imagen);

           echo Redirect::doIt("/producto/mostrarProductos");
    }

    public function modificar(){
        Permisos::validarAcceso(Rol::Contenidista);
        $data['idProductoAModificar']=$_GET['Id'];
        $data['producto']=$this->productoModel->getproductoConSuTipo($_GET['Id']); 
        echo $this->render->render("modificarProductoView.mustache", SesionData::cargar($data));
    }

    public function modificarProducto(){
        Permisos::validarAcceso(Rol::Contenidista);
        if(!empty($_FILES["imagen"]["name"])){

            move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/" . $_FILES["imagen"]["name"]);
            $imagen = $_FILES["imagen"]["name"];
        }else{
            $imagen =  $_POST['imageOld'];
        }
         
         $nombreProducto = $_POST['nombreProducto'];
         $tipoProducto = $_POST['tipoProducto'];

        $this->productoModel->updateProducto($_POST['Id'],$imagen,$nombreProducto,$tipoProducto);

        echo Redirect::doIt("/producto/mostrarProductos");

    }

    //Funciones utilizadas con Ajax

    public function listarProductosAjax()
    {
        $data = $this->productoModel->getProductos();
        echo "<select id='productos' name='producto' class='form-select' >";
        echo "<option value='default' selected>Seleccione un producto</option>";
        foreach ($data as $value) {
            echo "<option value='" . $value['Id'] . "'>" . $value['Nombre'] . "</option>";
        }
        echo "</select>";
    }

    public function imagenProductoAjax()
    {
        $data = $this->productoModel->getProducto($_POST["datos"])[0];
        echo "<img src='/public/".$data["Imagen"]."' class='img-fluid w-25 mt-5'>";
    }
}
