<?php
class NoticiaModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    //obtenemos una noticia
    public function getNoticia() {
        
    }

    //obtenemos todas las noticias
    public function getNoticias($idEdicionSeccion)
    {
        $sql = "SELECT Titulo, Id, IdEstadoNoticia FROM noticia WHERE IdEdicionSeccion = $idEdicionSeccion";
        return $this->database->query($sql);
    }

    public function getIdEdicionSeccion($edicion, $seccion)
    {
        $sql = "SELECT Id FROM edicionseccion WHERE IdEdicion = $edicion AND IdSeccion = $seccion";
        return $this->database->query($sql)[0]["Id"];
    }

    public function bajaNoticia($idNoticia){

        $sql=("DELETE from noticia where Id=$idNoticia;");
        $this->database->execute($sql);
    }

    //se ingresa la noticia en la base de datos
    public function addNoticia($datos) {
        $sql = "INSERT INTO noticia (titulo, subtitulo, cuerpo, idEdicionSeccion, coordenadaX, coordenadaY)
        VALUES ('".$datos["titulo"]."', '".$datos["subtitulo"]."', '".$datos["cuerpo"]."', ".$datos["idEdicionSeccion"].", 1, 1)";
        $idNoticia = $this->database->execute($sql);

        $sql = "INSERT INTO multimedia (nombre, idNoticia, idTipoMultimedia)
        VALUES ('".$datos["imagen"]."', $idNoticia, 2)";
        $this->database->execute($sql);

        //si encuentra un link
        if($datos["link"]){
            $sql = "UPDATE noticia
            SET link = '".$datos["link"]."'
            WHERE id = $idNoticia";
            $this->database->execute($sql);
        }

        //si encuentra una foto o video opcional
        if($datos["foto_o_video"]){
            $idTipoMultimedia = 4;
            $ext = substr($datos["foto_o_video"], -3);
            if($ext == 'jpg' || $ext == 'png')
                $idTipoMultimedia = 2;
            elseif($ext == 'mp4')
                $idTipoMultimedia = 3;
            $sql = "INSERT INTO multimedia (nombre, idNoticia, idTipoMultimedia)
            VALUES ('".$datos["foto_o_video"]."', $idNoticia, $idTipoMultimedia)";
            $this->database->execute($sql);
        }

        //si encuentra un audio
        if($datos["grabacion"]){
            $sql = "INSERT INTO multimedia (nombre, idNoticia, idTipoMultimedia)
            VALUES ('".$datos["grabacion"]."', $idNoticia, 1)";
            $this->database->execute($sql);
        }
    }
}
