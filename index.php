<?php
session_start();

include_once ("configuration/Configuration.php");
$configuration = new Configuration();

$router = $configuration->getRouter();

Mail::enviarGmail();

$router->redirect($_GET['controller'],$_GET['method']);