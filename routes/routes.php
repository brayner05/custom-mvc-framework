<?php

use Core\Request;
use Core\Router;

Router::get('/', function () {
    return "Hello, World!";
});

Router::get('/foo', function (Request $request) {
    return "Query: " . json_encode($request->query);
});

Router::post('/foo', function (Request $request) {
    header('Content-Type: text/json');
    return $request->body;
});
