<?php

namespace Core;

use RuntimeException;
use Smarty\Smarty;

class Router {
    private static array $get_handlers = [];
    private static array $post_handlers = [];
    private static array $put_handlers = [];
    private static array $delete_handlers = [];

    /**
     * Register a GET handler for a specific route/path.
     */
    public static function get(string $path, callable $callback) {
        Router::add_route_handler($path, 'GET', $callback);
    }

    /**
     * Register a POST handler for a specific route/path.
     */
    public static function post($path, callable $callback) {
        Router::add_route_handler($path, 'POST', $callback);
    }

    /**
     * Register a PUT handler for a specific route/path.
     */
    public static function put($path, callable $callback) {
        Router::add_route_handler($path, 'PUT', $callback);
    }

    /**
     * Register a DELETE handler for a specific route/path.
     */
    public static function delete($path, callable $callback) {
        Router::add_route_handler($path, 'DELETE', $callback);
    }

    /**
     * Finds the corresponding container for the request method and then attempts to
     * add the handler to that container. If the container already contains an entry for that
     * route, then an error is thrown.
     * 
     * @throws RuntimeException
     */
    private static function add_route_handler(string $path, string $method, callable $handler) {
        switch ($method) {
            case 'GET':
                $handler_container = &Router::$get_handlers;
                break;

            case 'POST':
                $handler_container = &Router::$post_handlers;
                break;

            case 'PUT':
                $handler_container = &Router::$put_handlers;
                break;

            case 'DELETE':
                $handler_container = &Router::$delete_handlers;
                break;

            default:
                throw new RuntimeException("Undefined request method $method");
        }

        if (isset($handler_container[$path])) {
            throw new RuntimeException("A $method handler already exists for route $path.");
        }

        $handler_container[$path] = $handler;
    }


    /**
     * Receive an HTTP request and pass it to it's corresponding handler,
     * if it exists.
     */
    public static function receive(Request $request) {
        $method = $request->method;
        $path = $request->path;

        switch ($method) {
            case 'GET':
                $callback = Router::$get_handlers[$path];
                return $callback($request);

            case 'POST':
                $callback = Router::$post_handlers[$path];
                return $callback($request);

            case 'PUT':
                $callback = Router::$put_handlers[$path];
                return $callback($request);

            case 'DELETE':
                $callback = Router::$delete_handlers[$path];
                return $callback($request);

            default:
                throw new \RuntimeException("Undefined method $method");
        }
    }
}
