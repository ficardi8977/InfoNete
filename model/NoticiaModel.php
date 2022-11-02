<?php
class NoticiaModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    //obtenemos una noticia
    public function getNoticia() {
        
    }

    //se ingresa la noticia en la base de datos
    public function addNoticia($titulo, $cuerpo, $imagen) {
        $sql = "INSERT INTO noticia (titulo, subtitulo, cuerpo, idEdicionSeccion, coordenadaX, coordenadaY, imagen)
        VALUES ('$titulo', '', '$cuerpo', 1, 1, 1, '$imagen')";

        $id = $this->database->execute($sql);
    }
}
