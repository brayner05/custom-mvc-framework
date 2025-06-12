<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/routes.php';

use Core\Router;
use Core\Request;

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$path = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_METHOD]";
$query = $_GET;
$body = file_get_contents('php://input');

$request = new Request($method, $path, $uri, $query, $body);
$response = Router::receive($request);

echo $response;
