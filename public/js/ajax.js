$(document).ready(function() {

    switch ($(".container").attr('id')) {
        case 'ABMNoticias':
            mostrarABMNoticias();
            break;
        case 'listarNoticias':
            $(".borrar").click(function(){
                borrar(this.value, "/noticia/baja");
                $("#noticia" + this.value).remove();
            });
            break;
        default:
            console.log("no hay contenedor");
            break;
    }

    function mostrarABMNoticias() {
        consulta('', "/noticia/listarProductos", "#listarProductos");

        $("#listarProductos").on("change", "#productos", function(){
            consulta(this.value, "/noticia/listarEdicionesPorProducto", "#listarEdiciones");
            });
        $("#listarEdiciones").on("change", "#ediciones", function(){
            $("#verNoticias").hide();
            consulta(this.value, "/noticia/listarSeccionesPorEdicion", "#listarSecciones");
            });
        $("#listarSecciones").on("change", "#secciones", function(){
            $("#verNoticias").show();
            verificarDefault("default");
        });
    }

    function borrar(datos, url) {
        $.ajax({
            data:  {datos: datos},
            type:  'POST',
            url:   url,
            // beforeSend: function () {
            //     $("#edicion").html("Procesando, espere por favor...");
            // },
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
                // beforeSend: function () {
                //     $("#edicion").html("Procesando, espere por favor...");
                // },
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