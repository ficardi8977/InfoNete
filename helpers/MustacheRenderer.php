<?php

class MustacheRenderer {
    private $mustache;
    private $viewFolder;

    public function __construct($viewFolder, $partialFolder) {
        $this->viewFolder = $viewFolder;

        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
                'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialFolder )
            ));
    }

    public function render($viewName, $datos = []) {
        $contentAsString =  file_get_contents($this->viewFolder . $viewName);
        echo  $this->mustache->render($contentAsString, $datos);
    }
}