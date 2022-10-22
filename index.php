<?php

include_once ("configuration/Configuration.php");
$configuration = new Configuration();
$router = $configuration->getRouter();

$router->redirect($_GET['controller'],$_GET['method']);