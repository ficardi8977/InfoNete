$(document).ready(function() {

    switch ($(".container").attr('id')) {
        case 'ABMNoticias':
            mostrarABMNoticias();
            break;
        case 'noticias':
            listarNoticias();
            break;
        default:
            console.log("no hay contenedor");
            break;
    }

    function listarNoticias() {
        $(".borrar1").click(function(){
            borrar(this.value, "/noticia/baja");
            $("#noticia" + this.value).remove();
        });

        //estado noticia y botones contenidista
        $(".modificar1").prop('disabled', false);
        $(".modificar2").html('En espera...');
        $(".modificar3").html('Publicada');
        $(".publicar1").html('Publicar');
        $(".borrar1").prop('disabled', false);

        $("#busqueda").keyup(function(){
            buscar($(this).val(), "/noticia/buscar", "#listarNoticias");
        });
    }

    function mostrarABMNoticias() {
        consulta('', "/producto/listarProductosAjax", "#listarProductos");

        $("#listarProductos").on("change", "#productos", function(){
            consulta(this.value, "/edicion/listarEdicionesAjax", "#listarEdiciones");
            consulta(this.value,"/producto/imagenProductoAjax", "#imagen");
            });
        $("#listarEdiciones").on("change", "#ediciones", function(){
            $("#verNoticias").hide();
            consulta(this.value, "/seccion/listarSeccionesAjax", "#listarSecciones");
            });
        $("#listarSecciones").on("change", "#secciones", function(){
            $("#verNoticias").show();
            verificarDefault("default");
        });
    }

    function buscar(datos, url, campo) { 
        $.ajax({
            data:  {datos: datos},
            type:  'GET',
            url:   url,
            beforeSend: function () {
                
            },
            success:  function (resultado) {
                $(campo).html(resultado);
            }
        });
    }

    function borrar(datos, url) {
        $.ajax({
            data:  {datos: datos},
            type:  'POST',
            url:   url,
            beforeSend: function () {
                
            },
            success:  function (resultado) {
                console.log(resultado);
            }
        });
    }

    function consulta(datos, url, campo) {
        if(verificarDefault(campo)){
            $.ajax({
                data:  {datos: datos},
                type:  'POST',
                url:   url,
                beforeSend: function () {
                    
                },
                success:  function (resultado) {
                    $(campo).html(resultado);
                }
            });
        }
    }

    function verificarDefault(campo){
        let ediciones = $("#listarEdiciones");
        let secciones = $("#listarSecciones");
        let verNoticias = $("#verNoticias");

        if($("#productos").val() == "default" && campo == "#listarEdiciones"){
            ediciones.html('');
            secciones.html('');
            verNoticias.hide();
            $("#imagen").html('');
            return false;
        }

        if($("#ediciones").val() == "default" && campo == "#listarSecciones"){
            secciones.html('');
            verNoticias.hide();
            return false;
        }

        if($("#secciones").val() == "default" && campo == "default"){
            verNoticias.hide();
            return false;
        }
        return true;
    }
});