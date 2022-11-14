<?php
session_start();



include_once ("configuration/Configuration.php");
$configuration = new Configuration();

$router = $configuration->getRouter();

Mail::enviar();

$router->redirect($_GET['controller'],$_GET['method']);