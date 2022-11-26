<?php

class ReporteController{
    private $usuarioModel;
    private $productoModel;
    private $render;

    public function __construct($usuarioModel,$productoModel,$render){

        $this->usuarioModel= $usuarioModel;
        $this->productoModel= $productoModel;
        $this->render= $render;

    }

    public function mostrarReportes(){
       Permisos::validarAcceso(Rol::Administrador);
       echo $this->render->render("reportesView.mustache", SesionData::cargar());
    }


    public function mostrarProductosSuscriptosyComprados(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["usuarios"]= $this->usuarioModel->getUsuariosConTipo();
        $data["productosCompradosYSuscriptosPorUsuario"]=$this->usuarioModel->productosCompradosYsuscriptosPorUsuario();
         $html = $this->render->render("listaCompraYSuscripcionProductosView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html,'SuscriptosYComprados.pdf');
    }
    
    public function mostrarProductosconCantidades(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["productos"] = $this->productoModel->reporteConCantidades();
        $html = $this->render->render("listaProductosConInfo.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html,'Productos.pdf');
    }
    
    public function reporteMisCompras(){
        Permisos::validarAcceso(Rol::Lector);
        $fechaDesde = $_GET['fechaDesde'];
        $fechaHasta = $_GET['fechaHasta'];
        $data['compras'] = $this->usuarioModel->reporteCompras($fechaDesde, $fechaHasta);
        $html = $this->render->render("reporteMisComprasView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html,'MisCompras.pdf');
    }

        public function mostrarUsuariosContenidistas(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["usuariosContenidistas"]= $this->usuarioModel->getUsuariosContenidistas();
        $html = $this->render->render("listaContenidistasView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html,'UsuariosContenidistas.pdf');
    }
}

