<?php

require __DIR__ . '/../core/response_util.php';

use Core\Request;
use Core\Router;

Router::get('/', function () {
    return view('home');
});

Router::get('/foo', function (Request $request) {
    return view('foo', [
        'message' => 'Hello',
        'recipient' => 'World'
    ]);
});

Router::post('/foo', function (Request $request) {
    return json($request->body);
});
