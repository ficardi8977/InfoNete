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
    public function modificar(){
           $idProducto= $_POST["Id"];
           $data['producto']=$this->productoModel->getproducto($idProducto); 
           $data['TiposProducto']=$this->productoModel->getTiposProducto();
           echo $this->render->render("modificarProductoView.mustache", $this->sesion->cargar($data));

    }

    public function modificarProducto(){

    }

}
