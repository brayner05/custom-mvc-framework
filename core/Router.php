<?php

namespace Core;

class Router {
    private static array $get_handlers = [];
    private static array $post_handlers = [];
    private static array $put_handlers = [];
    private static array $delete_handlers = [];

    public static function get($uri, callable $callback) {
        if (isset(Router::$get_handlers[$uri])) {
            throw new \RuntimeException("Route $uri already has a GET handler");
        }
        Router::$get_handlers[$uri] = $callback;
    }

    public static function post($uri, callable $callback) {
        if (isset(Router::$post_handlers[$uri])) {
            throw new \RuntimeException("Route $uri already has a POST handler");
        }
        Router::$post_handlers[$uri] = $callback;
    }

    public static function put($uri, callable $callback) {
        if (isset(Router::$put_handlers[$uri])) {
            throw new \RuntimeException("Route $uri already has a PUT handler");
        }
        Router::$put_handlers[$uri] = $callback;
    }

    public static function delete($uri, callable $callback) {
        if (isset(Router::$delete_handlers[$uri])) {
            throw new \RuntimeException("Route $uri already has a DELETE handler");
        }
        Router::$delete_handlers[$uri] = $callback;
    }

    public static function receive(Request $request) {
        $method = $request->method;
        $uri = $request->uri;

        switch ($method) {
            case 'GET':
                $callback = Router::$get_handlers[$uri];
                return $callback();

            case 'POST':
                $callback = Router::$post_handlers[$uri];
                return $callback();

            case 'PUT':
                $callback = Router::$put_handlers[$uri];
                return $callback();

            case 'DELETE':
                $callback = Router::$delete_handlers[$uri];
                return $callback();

            default:
                throw new \RuntimeException("Undefined method $method");
        }
    }
}
