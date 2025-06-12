<?php

use Core\View;

/**
 * Set the content type to text/json and return `$response_body`.
 */
function json(string $response_body): string {
    header('Content-Type: text/json');
    return $response_body;
}

/**
 * Return a view by it's name. Views are found in `/app/Views` and end in
 * `.view.php`.
 */
function view(string $view_name, $data = []): View {
    return new View($view_name . '.tpl', $data);
}
