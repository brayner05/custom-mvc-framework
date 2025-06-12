<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/routes.php';

use Core\Router;
use Core\Request;
use Core\View;
use Smarty\Smarty;

// Initialize Smarty (View Engine).
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/../app/Views');
$smarty->setConfigDir(__DIR__ . '/../config');
$smarty->setCacheDir(__DIR__ . '/../build/cache');

// Capture request information.
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH) ?? '/';
$query = $_GET;
$body = file_get_contents('php://input');

// Create a new request object from the request information.
$request = new Request($method, $path, $uri, $query, $body);

// Pass the request to the router.
$response = Router::receive($request);

// Respond to the client.
if ($response instanceof View) {
    render_view($response);
} else {
    echo $response;
}

/**
 * Compile a view and then render it.
 */
function render_view(View $view) {
    global $smarty;
    foreach ($view->data as $key => $value) {
        $smarty->assign($key, $value);
    }
    $smarty->display($view->name);
}
