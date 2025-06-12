<?php

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
function view(string $view_name, $data = []) {
    // Construct the file path to the view from $view_name.
    $view_file = __DIR__ . '/../app/Views/' . $view_name . '.view.php';

    // Verify that the view actually exists.
    if (!file_exists($view_file)) {
        throw new RuntimeException("Could not locate view file $view_file");
    }

    // Extract variables from $data into local scope.
    extract($data, EXTR_SKIP);

    // Capture the view file.
    ob_start();
    require $view_file;
    $content = ob_get_clean();

    // Return the view.
    return $content;
}
