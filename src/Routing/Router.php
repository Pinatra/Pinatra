<?php
namespace Pinatra\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    private static $routes = [];
    private static $currentGroup = '';
    public static $baseNamespace = '\\';

    public static function group($prefix, $callback)
    {
        $previousGroup = self::$currentGroup;
        self::$currentGroup .= $prefix;
        $callback();
        self::$currentGroup = $previousGroup;
    }

    private static function addRoute($method, $path, $handler)
    {
        self::$routes[] = [
            'method' => $method,
            'path' => ltrim($path, '/'),
            'handler' => $handler
        ];
    }

    public static function get($path, $handler)
    {
        self::addRoute('GET', $path, $handler);
    }

    public static function post($path, $handler)
    {
        self::addRoute('POST', $path, $handler);
    }

    public static function put($path, $handler)
    {
        self::addRoute('PUT', $path, $handler);
    }

    public static function delete($path, $handler)
    {
        self::addRoute('DELETE', $path, $handler);
    }

    public static function patch($path, $handler)
    {
        self::addRoute('PATCH', $path, $handler);
    }

    public static function options($path, $handler)
    {
        self::addRoute('OPTIONS', $path, $handler);
    }

    public static function head($path, $handler)
    {
        self::addRoute('HEAD', $path, $handler);
    }

    private static function resolveHandler($handler)
    {
        if (is_string($handler) && strpos($handler, '@') !== false) {
            list($class, $method) = explode('@', $handler);
            if ($class[0] !== '\\') {
                $class = self::$baseNamespace . $class;
            }
            $controller = new $class();
            return [$controller, $method];
        }
        return $handler;
    }

    public static function dispatch($method, $uri, $after = null)
    {
        static $dispatcher = null;
        
        if ($dispatcher === null) {
            $dispatcher = simpleDispatcher(function(RouteCollector $r) {
                foreach (self::$routes as $route) {
                    $r->addRoute($route['method'], self::$currentGroup . $route['path'], $route['handler']);
                }
            });
        }

        $path = parse_url($uri, PHP_URL_PATH);
        $path = $path ? rtrim(ltrim($path, '/'), '/') : '/';
        $routeInfo = $dispatcher->dispatch($method, $path);
        
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return false;
            case Dispatcher::METHOD_NOT_ALLOWED:
                return false;
            case Dispatcher::FOUND:
                $handler = self::resolveHandler($routeInfo[1]);
                $vars = $routeInfo[2];
                $return = call_user_func_array($handler, $vars);
                
                // call View processor
                if ($after) {
                    $after_segments = explode('@', $after);
                    $after_segments[0]::{$after_segments[1]}($return);
                }
                
                return $return;
        }
    }
}
