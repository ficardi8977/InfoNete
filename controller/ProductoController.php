<?php
class ProductoController {
    private $productoModel;
     private $render;
    private $sesion;


    public function __construct($productoModel,$render,$sesion){
        $this->productoModel=$productoModel;
        $this->render=$render;
        $this->sesion=$sesion;
        }

    public function mostrarProductos(){

           $data['productos']=$this->productoModel->getProductosConSuTipo(); 
           echo $this->render->render("productosView.mustache", $this->sesion->cargar($data));
    }   

    public function baja(){  
             $this->productoModel->bajaProducto($_POST["Id"]);
             Redirect::doIt("/producto/mostrarProductos");
    }

    /*
    public function modificar(){
           $idProducto= $_POST["Id"];
           $data['producto']=$this->productoModel->getproducto($idProducto); 
           $data['TiposProducto']=$this->productoModel->getTiposProducto();
           echo $this->render->render("modificarProductoView.mustache", $this->sesion->cargar($data));

    }
    */

    public function alta(){
        echo $this->render->render("altaProductoView.mustache");
    }

    public function altaProducto(){
            $nombreProducto = $_POST['nombreProducto'];
            $tipoProducto = isset($_POST['tipoProducto']);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/" . $_FILES["imagen"]["name"]);  //tmp_name ruta donde guarda el apache el archivo
            $imagen = $_FILES["imagen"]["name"];  // Para obtener solo el nombre de la imagen
        
            $this->productoModel->altaProducto($nombreProducto,$tipoProducto,$imagen);

           echo Redirect::doIt("/producto/mostrarProductos");
    }

    public function modificar(){
        $data['idProductoAModificar']=$_GET['Id'];
        $data['producto']=$this->productoModel->getproductoConSuTipo($_GET['Id']); 
        echo $this->render->render("modificarProductoView.mustache",$this->sesion->cargar($data));
    }

    public function modificarProducto(){
         move_uploaded_file($_FILES["imagen"]["tmp_name"], "public/" . $_FILES["imagen"]["name"]); 
         $imagen = $_FILES["imagen"]["name"];
         $nombreProducto = $_POST['nombreProducto'];
         $tipoProducto = isset($_POST['tipoProducto']);

        $this->productoModel->updateProducto($_POST['Id'],$imagen,$nombreProducto,$tipoProducto);

        echo Redirect::doIt("/producto/mostrarProductos");

    }

}
