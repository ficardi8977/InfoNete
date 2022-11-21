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
        $(document).on("click", ".borrar1", function(){
            buttonClick(this.value, "/noticia/baja");
            $("#noticia" + this.value).remove();
        });

        $(document).on("click", ".presentar1", function(){
            buttonClick(this.value, "/noticia/presentar");
            $(this).html("Leer");
            $(this).prop('class', 'btn btn-info text-light leer2');
            $("#modificar"+$(this).val()+"").prop('disabled', true);
            $("#modificar"+$(this).val()+"").html('En espera...');
            $("#borrar"+$(this).val()+"").prop('disabled', true);
        });

        $(document).on("click", ".leer2", function(){
            $(".form-leer"+$(this).val()+"").submit();
        });

        $(document).on("click", ".aprobar2", function(){
            buttonClick(this.value, "/noticia/aprobar");
            $(this).html("Aprobada");
            $(this).prop('disabled', true);
            $("#rechazar"+$(this).val()+"").prop('disabled', true);
        });

        $(document).on("click", ".rechazar2", function(){
            buttonClick(this.value, "/noticia/banear");
            $(this).html("Rechazada");
            $(this).prop('disabled', true);
            $("#aprobar"+$(this).val()+"").prop('disabled', true);
        });

        $(document).on("click", ".banear3", function(){
            buttonClick(this.value, "/noticia/banear");
            $(this).html("Desbanear");
            $(this).prop("class", "btn btn-danger desbanear");
        });
        
        $(document).on("click", ".desbanear", function(){
            buttonClick(this.value, "/noticia/desbanear");
            $(this).html("Banear");
            $(this).prop("class", "btn btn-danger banear3");
        });


        //estado noticia y botones contenidista
        //estados: 1=Borrador 2=A publicar 3=Publicada 4=Baneada
        function modificarBotones(){
            //boton modificar
            $(".modificar1").prop('disabled', false);
            $(".modificar2").html('En espera...');
            $(".modificar3").html('Publicada');
            $(".modificar4").html('Rechazada');
            //boton leer (se convierte en presentar)
            $(".leer1").html('Presentar');
            $(".leer1").prop('class', 'btn btn-info text-light presentar1');
            //boton borrar
            $(".borrar1").prop('disabled', false);
            //boton aprobar
            $(".aprobar2").prop('disabled', false);
            $(".aprobar3").html('Aprobada');
            //boton rechazar
            $(".rechazar2").prop('disabled', false);
            $(".rechazar4").html('Rechazada');
            //boton banear (se convierte en desbanear)
            $(".banear3").prop('disabled', false);
            $(".banear4").html('Desbanear');
            $(".banear4").prop({
                class: 'btn btn-danger desbanear',
                disabled: false
            });
        }

        modificarBotones();

        $("#busqueda").keyup(function(){
            if(!$("#busqueda").val()){
                $("#listarNoticias").html('');
                $("#busquedaVacia").html("Ingrese una letra o palabra para comenzar la búsqueda");
            }
            else{
                $("#busquedaVacia").html('');
                buscar($(this).val(), "/noticia/buscar", "#listarNoticias");
                modificarBotones();
            }
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

        $("#buscar").submit(function(e){
            if(!$("#busqueda").val())
                e.preventDefault($("#busquedaVacia").html("Ingrese una letra o palabra para realizar la búsqueda"));
        });
    }

    function buscar(datos, url, campo) { 
        $.ajax({
            data:  {datos: datos},
            type:  'GET',
            url:   url,
            async: false,
            beforeSend: function () {
                
            },
            success:  function (resultado) {
                    $(campo).html(resultado);
            }
        });
    }

    function buttonClick(datos, url) {
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