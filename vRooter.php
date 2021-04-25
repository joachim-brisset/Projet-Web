<?php

class vRooter
{
    const GET = 'GET';
    const POST = 'POST';

    private static $routes = [];

    private function __construct() {}

    public static function addMethodRoute(string $method, string $route, string $controller)
    {
        if($method != self::POST AND $method != self::GET) throw new InvalidArgumentException('$method must be a defined constant in Router');
        if($route == "" OR !isset($route)) throw new InvalidArgumentException('$route must not be null');
        if(!class_exists($controller)) throw new InvalidArgumentException('$controller must exist as a class');

        self::$routes[$route] = [$method => $controller];
    }

    public static function addRoute(string $route, $controllers)
    {
        if($route == "" OR !isset($route)) throw new InvalidArgumentException('$route must not be null');
        if (is_array($controllers) OR is_string($controllers)) {
            if (is_string($controllers) AND !class_exists($controllers)) throw new InvalidArgumentException('$controllers must exist as a class');
            if (is_array($controllers)) {

                foreach ($controllers as $method => $controller) {
                    if (!class_exists($controller)) throw new InvalidArgumentException('each $controllers element must exist as a class');
                    if ($method != self::GET AND $method != self::POST) throw new InvalidArgumentException('each $controllers key must be a defined constant in Router');
                }
            }


        } else {
            throw new InvalidArgumentException('$controllers must be an array or string');
        }

        self::$routes[$route] = (is_array($controllers))? $controllers :[self::GET => $controllers, self::POST => $controllers];
    }



    public static function run(string $basePath)
    {
        #todo handle # in url
        $path = str_replace($basePath, "", $_SERVER['REQUEST_URI']);
        $t = self::$routes[$path][$_SERVER['REQUEST_METHOD']] ?? null;
        if(isset($t)) {
            $class = new $t();
            $class->index();
        } else {
            echo '404 not found';
        }
    }
}