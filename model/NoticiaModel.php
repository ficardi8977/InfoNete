<?php
class NoticiaModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    //obtenemos todas las noticias
    public function getNoticias($idEdicionSeccion)
    {
        $sql = "SELECT n.Titulo, n.Id, n.IdEstadoNoticia, p.Nombre Producto, s.Nombre Seccion, e.Numero Edicion
        FROM noticia n
        JOIN edicionseccion es
        ON n.IdEdicionSeccion = es.Id
        JOIN seccion s
        ON es.IdSeccion = s.Id
        JOIN edicion e
        ON es.IdEdicion = e.Id
        JOIN producto p
        ON e.IdProducto = p.Id
        WHERE IdEdicionSeccion = $idEdicionSeccion";
        return $this->database->query($sql);
    }

    //obtenemos una noticia
    public function getNoticia($id)
    {
        $noticia = $this->database->query("SELECT * FROM noticia WHERE id = $id")[0];
        $multimedia = $this->database->query("SELECT m.* FROM multimedia m JOIN noticia n ON m.idNoticia = n.id WHERE m.idNoticia = $id");
        $noticia["imagen"] = $multimedia[0]["Nombre"];
        $noticia["idImagen"] = $multimedia[0]["Id"];
            foreach ($multimedia as $key => $value) {
                if($key != 0){
                    if($value['IdTipoMultimedia'] == 2){
                        $noticia["foto"] = $value['Nombre'];
                        $noticia["idFoV"] = $value['Id'];
                    }
                    elseif($value['IdTipoMultimedia'] == 3){
                        $noticia["video"] = $value['Nombre'];
                        $noticia["idFoV"] = $value['Id'];
                    }
                    if($value['IdTipoMultimedia'] == 1){
                        $noticia["grabacion"] = $value['Nombre'];
                        $noticia["idGrabacion"] = $value['Id'];
                    }
                }
            }
        return $noticia;
    }

    public function getIdEdicionSeccion($edicion, $seccion)
    {
        $sql = "SELECT Id FROM edicionseccion WHERE IdEdicion = $edicion AND IdSeccion = $seccion";
        return $this->database->query($sql)[0]["Id"];
    }

    public function verificarEstadoNoticia($idNoticia)
    {
        $sql = "SELECT IdEstadoNoticia FROM noticia WHERE id = $idNoticia";
        return $this->database->query($sql)[0]["IdEstadoNoticia"];
    }

    public function bajaNoticia($idNoticia){

        $sql=("DELETE from noticia where Id=$idNoticia");
        $this->database->execute($sql);
    }

    public function presentarNoticia($idNoticia)
    {
        $sql=("UPDATE noticia SET idEstadoNoticia = 2 WHERE Id=$idNoticia");
        $this->database->execute($sql);
    }

    public function aprobarNoticia($idNoticia)
    {
        $sql=("UPDATE noticia SET idEstadoNoticia = 3 WHERE Id=$idNoticia");
        $this->database->execute($sql);
    }

    public function banearNoticia($idNoticia)
    {
        $sql=("UPDATE noticia SET idEstadoNoticia = 4 WHERE Id=$idNoticia");
        $this->database->execute($sql);
    }

    public function desbanearNoticia($idNoticia)
    {
        $sql=("UPDATE noticia SET idEstadoNoticia = 3 WHERE Id=$idNoticia");
        $this->database->execute($sql);
    }

    //se ingresa la noticia en la base de datos
    public function addNoticia($datos) {
        $sql = "INSERT INTO noticia (titulo, subtitulo, cuerpo, idEdicionSeccion, coordenadaX, coordenadaY, IdEstadoNoticia)
        VALUES ('".$datos["titulo"]."', '".$datos["subtitulo"]."', '".$datos["cuerpo"]."', ".$datos["idEdicionSeccion"].", ".$datos["coordenadasX"].",
        ".$datos["coordenadasY"].", 1)";
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
            if($ext == 'jpg' || $ext == 'png' || 'peg')
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

    public function updateNoticia($datos)
    {
        $sql = "UPDATE noticia
        SET titulo = '".$datos["titulo"]."', subtitulo = '".$datos["subtitulo"]."', cuerpo = '".$datos["cuerpo"]."',
        coordenadaX = ".$datos["coordenadasX"].", coordenadaY = ".$datos["coordenadasY"]."
        WHERE id = ".$datos["id"]."";
        $this->database->execute($sql);

        //si encuentra nueva imagen
        if($datos["imagen"]){
            $sql = "UPDATE multimedia
            SET nombre = '".$datos["imagen"]."'
            WHERE id = ".$datos["idImagen"]."";
            $this->database->execute($sql);
        }

        //si encuentra un link
        if($datos["link"]){
            $sql = "UPDATE noticia
            SET link = '".$datos["link"]."'
            WHERE id = ".$datos["id"]."";
            $this->database->execute($sql);
        }

        //si encuentra una foto o video opcional
        if($datos["foto_o_video"]){
            if($datos["idFoV"]){
                $sql = "UPDATE multimedia
                SET nombre = '".$datos["foto_o_video"]."'
                WHERE id = ".$datos["idFoV"]."";
            }
            else{
                $idTipoMultimedia = 4;
                $ext = substr($datos["foto_o_video"], -3);
                if($ext == 'jpg' || $ext == 'png' || 'peg')
                    $idTipoMultimedia = 2;
                elseif($ext == 'mp4')
                    $idTipoMultimedia = 3;
                $sql = "INSERT INTO multimedia (nombre, idNoticia, idTipoMultimedia)
                VALUES ('".$datos["foto_o_video"]."', ".$datos["id"].", $idTipoMultimedia)";
            }
            $this->database->execute($sql);
        }

        //si encuentra un audio
        if($datos["grabacion"]){
            if($datos["idGrabacion"]){
                $sql = "UPDATE multimedia
                SET nombre = '".$datos["foto_o_video"]."'
                WHERE id = ".$datos["idFoV"]."";
            }
            else{
                $sql = "INSERT INTO multimedia (nombre, idNoticia, idTipoMultimedia)
                VALUES ('".$datos["grabacion"]."', ".$datos["id"].", 1)";                
            }
            $this->database->execute($sql);
        }
    }

    public function buscarNoticia($busqueda)
    {
        $sql = "SELECT n.Titulo, n.Id, n.IdEstadoNoticia, p.Nombre Producto, s.Nombre Seccion, e.Numero Edicion
        FROM noticia n
        JOIN edicionseccion es
        ON n.IdEdicionSeccion = es.Id
        JOIN seccion s
        ON es.IdSeccion = s.Id
        JOIN edicion e
        ON es.IdEdicion = e.Id
        JOIN producto p
        ON e.IdProducto = p.Id
        WHERE n.Titulo LIKE '%$busqueda%'
        OR s.Nombre LIKE '%$busqueda%'
        OR p.Nombre LIKE '%$busqueda%'";
        return $this->database->query($sql);
    }
}
