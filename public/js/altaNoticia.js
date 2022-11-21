$(document).ready(function() {
    loadMap();
    $("video").prop('volume', 0.5);
    $("#imagen").change(function(){
        var url = URL.createObjectURL($(this)[0].files[0]);
        if($("#imagen_").lenght)
            $("#imagen_").src = url;
        else
            $("#verImagen").html("<img id='imagen_' src=" + url + " class='img-fluid'>");
    });

    $("#foto_o_video").change(function(){
        var url = URL.createObjectURL($(this)[0].files[0]);
        $("#verFoto").remove();
        $("#verVideo").remove();
        if($(this).val().slice(-3) == 'mp4'){
            $("#verFotoOVideo").removeAttr('class');
            $("#verFotoOVideo").html("<video class='w-50' src=" + url + " controls></video>");
            $("video").prop('volume', 0.5);
        }
        else{
            $("#verFotoOVideo").attr('class', 'col-md-2');
            $("#verFotoOVideo").html("<img id='imagen_' src=" + url + " class='img-fluid'>");
        }
    });
});