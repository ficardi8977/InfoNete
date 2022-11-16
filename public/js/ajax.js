$(document).ready(function() {
    var texto = $("#listarNoticias").html();
    console.log(texto);

    $("#productos").change(function(){
        consulta(this.value, "/noticia/listarEdicionesPorProducto", "#listarEdiciones");
        });
    $("#listarEdiciones").on("change", "#ediciones", function(){
        consulta(this.value, "/noticia/listarSeccionesPorEdicion", "#listarSecciones");
        });
    $("#listarSecciones").on("change", "#secciones", function(){
        var parametros = {
            "edicion" : $("#ediciones").val(),
            "seccion" : $("#secciones").val()
        };
        consulta(parametros, "/noticia/listarNoticias", "#listarNoticias");
    });

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
        let noticias = $("#listarNoticias");

        if($("#productos").val() == "default" && campo == "#listarEdiciones"){
            ediciones.html('');
            secciones.html('');
            noticias.html(texto);
            return false;
        }

        if($("#ediciones").val() == "default" && campo == "#listarSecciones"){
            secciones.html('');
            noticias.html(texto);
            return false;
        }

        if($("#secciones").val() == "default" && campo == "#listarNoticias"){
            noticias.html(texto);
            return false;
        }
        return true;
    }
});