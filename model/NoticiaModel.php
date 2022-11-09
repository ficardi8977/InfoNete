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
    public function getNoticias()
    {
        return $this->database->query("SELECT * FROM noticia");
    }

    //se ingresa la noticia en la base de datos
    public function addNoticia($datos) {
        $sql = "INSERT INTO noticia (titulo, subtitulo, cuerpo, idEdicionSeccion, coordenadaX, coordenadaY)
        VALUES ('".$datos["titulo"]."', '".$datos["subtitulo"]."', '".$datos["cuerpo"]."', 1, 1, 1)";
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
            $sql = "INSERT INTO multimedia (nombre, idNoticia, idTipoMultimedia)
            VALUES ('".$datos["foto_o_video"]."', $idNoticia, 2)";
            $this->database->execute($sql);
        }
    }
}
