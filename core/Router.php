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
    public static function get(string $path, callable|array $handler) {
        Router::add_route_handler($path, 'GET', $handler);
    }


    /**
     * Register a POST handler for a specific route/path.
     */
    public static function post($path, callable $handler) {
        Router::add_route_handler($path, 'POST', $handler);
    }

    /**
     * Register a PUT handler for a specific route/path.
     */
    public static function put($path, callable $handler) {
        Router::add_route_handler($path, 'PUT', $handler);
    }

    /**
     * Register a DELETE handler for a specific route/path.
     */
    public static function delete($path, callable $handler) {
        Router::add_route_handler($path, 'DELETE', $handler);
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
                $handler = Router::$get_handlers[$path];
                return $handler($request);

            case 'POST':
                $handler = Router::$post_handlers[$path];
                return $handler($request);

            case 'PUT':
                $handler = Router::$put_handlers[$path];
                return $handler($request);

            case 'DELETE':
                $handler = Router::$delete_handlers[$path];
                return $handler($request);

            default:
                throw new \RuntimeException("Undefined method $method");
        }
    }
}
