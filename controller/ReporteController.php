<?php

class ReporteController{
    private $usuarioModel;
    private $render;

    public function __construct($usuarioModel,$render){

        $this->usuarioModel= $usuarioModel;
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
        GeneradorPdf::generarPdf($html);
    }

    public function mostrarProductosConInfo(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["productos"] = $this->usuarioModel->getProductosConSuTipo();
        $data["cantidadProductosVendidos"] = $this->usuarioModel->cantidadProductosVendidos();
        $data["cantidadProductosSuscriptos"] = $this->usuarioModel->cantidadProductosSuscriptos();
        $html = $this->render->render("listaProductosConInfo.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html);
    }
    
    public function reporteMisCompras(){
        Permisos::validarAcceso(Rol::Lector);
        $fechaDesde = $_GET['fechaDesde'];
        $fechaHasta = $_GET['fechaHasta'];
        $data['compras'] = $this->usuarioModel->reporteCompras($fechaDesde, $fechaHasta);
        $html = $this->render->render("reporteMisComprasView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html);
    }

        public function mostrarUsuariosContenidistas(){
        Permisos::validarAcceso(Rol::Administrador);
        $data["usuariosContenidistas"]= $this->usuarioModel->getUsuariosContenidistas();
        $html = $this->render->render("listaContenidistasView.mustache", SesionData::cargar($data));
        GeneradorPdf::generarPdf($html);
    }
}

