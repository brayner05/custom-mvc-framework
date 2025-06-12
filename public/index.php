<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/routes.php';

use Core\Router;
use Core\Request;

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH) ?? '/';
$query = $_GET;
$body = file_get_contents('php://input');

$request = new Request($method, $path, $uri, $query, $body);
$response = Router::receive($request);

echo $response;
