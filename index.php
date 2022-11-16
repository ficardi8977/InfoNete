<?php
session_start();

include_once ("configuration/Configuration.php");

$configuration = new Configuration();

$router = $configuration->getRouter();

$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
$method = isset($_GET['method']) ? $_GET['method'] : '';

$router->redirect($controller,$method);