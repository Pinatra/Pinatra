<?php

namespace Pinatra\Routing;

/**
 * @method static Router get(string $route, Callable $callback)
 * @method static Router post(string $route, Callable $callback)
 * @method static Router put(string $route, Callable $callback)
 * @method static Router patch(string $route, Callable $callback)
 * @method static Router delete(string $route, Callable $callback)
 * @method static Router options(string $route, Callable $callback)
 * @method static Router head(string $route, Callable $callback)
 */
class Router {

  public static $routes = [];

  public static $methods = [];

  public static $callbacks = [];

  public static $baseNamespace = '\\';

  public static $prefix = [];

  public static $error_callback;

  /**
   * add filter for your routes
   */
  public static function filter($filter, $result) {
    if ($filter()) {
      $result();
    }
  }

  /**
   * Defines a route w/ callback and method
   */
  public static function __callstatic($method, $params)
  {
    $uri = $params[0];
    if ($uri === '') {
      $uri = '/';
    } else if ($uri === '/') {
      // do nothing
    } else {
      if (strpos($uri, '/') === 0) {
        $uri = substr($uri, 1);
      }
    }
    $callback = $params[1];
    if ( $method == 'any' ) {
      self::pushToArray($uri, 'get', $callback);
      self::pushToArray($uri, 'post', $callback);
      self::pushToArray($uri, 'put', $callback);
      self::pushToArray($uri, 'patch', $callback);
      self::pushToArray($uri, 'delete', $callback);
      self::pushToArray($uri, 'options', $callback);
      self::pushToArray($uri, 'head', $callback);
    } else {
      self::pushToArray($uri, $method, $callback);
    }
  }

  /**
   * Push route items to class arrays
   *
   */
  public static function pushToArray($uri, $method, $callback)
  {
    array_push(self::$routes, $uri);
    array_push(self::$methods, strtoupper($method));
    array_push(self::$callbacks, $callback);
  }

  /**
   * Defines callback if route is not found
  */
  public static function error($callback)
  {
    self::$error_callback = $callback;
  }

  /**
   * Runs the callback for the given request
   *
   * $after: Processor After. It will process the value returned by Controller.
   * Example: View@process
   *
   */
  public static function dispatch($after = null)
  {
    $uri = self::detect_uri();
    $method = $_SERVER['REQUEST_METHOD'];
    $routeMatch = false;
    // check if route is defined without regex
    if (in_array($uri, self::$routes)) {
      $route_pos = array_keys(self::$routes, $uri);
      $route = current($route_pos);
      foreach ($route_pos as $route) {

        if ($routeMatch) {
          break;
        }

        // if HTTP method match GET POST PUT ...
        if (self::$methods[$route] == $method) {
          $routeMatch = true;

          //if route is not an object
          if(!is_object(self::$callbacks[$route])){

            //grab all parts based on a / separator
            $parts = explode('/',self::$callbacks[$route]);
            //collect the last index of the array
            $last = end($parts);
            //grab the controller name and method call
            $segments = explode('@',$last);
            //instanitate controller
            $controllerName = self::$baseNamespace.'\\'.$segments[0];
            $controller = new $controllerName;

            //call method and pass any extra parameters to the method
            $methodName = $segments[1];
            $method = new \ReflectionMethod($controller, $methodName);
            $nullParamsArray = array_fill(0, $method->getNumberOfRequiredParameters(), NULL);
            $return = call_user_func_array([$controller, $methodName], $nullParamsArray);
          } else {
            $closureFunction = new \ReflectionFunction(self::$callbacks[$route]);
            $nullParamsArray = array_fill(0, $closureFunction->getNumberOfRequiredParameters(), NULL);
            $return = call_user_func_array(self::$callbacks[$route], $nullParamsArray);
          }

          // call View processor
          if ($after) {
            $after_segments = explode('@', $after);
            $after_segments[0]::{$after_segments[1]}($return);
          }
        }
      }
    } else {
      // check if defined with regex

      foreach (self::$routes as $key => $route) {
        
        if ($routeMatch) {
          break;
        }
        if (preg_match('/\{.*?\}/', $route)) {

          $paramsIndexArray = [];
          // notice that this $route is like /home/{name}
          // explode('/', $route)[0] == ''
          foreach (explode('/', $route) as $k => $v) {
            if (preg_match('/\{.*?\}/', $v)) {
              $paramsIndexArray[] = $k;
            }
          }

          $route = preg_replace('/\{.*?\}/', '[^/]+', $route);

          if (preg_match('#^' . $route . '$#', $uri, $matched)) {

            $realMatched = [];
            foreach (explode('/', $matched[0]) as $k => $v) {
              if (in_array($k, $paramsIndexArray)) {
                $realMatched[] = $v;
              }
            }

            if (self::$methods[$key] == $method) {
              $routeMatch = true;

              // this can be object(Closure), if is, go to else
              if(!is_object(self::$callbacks[$key])){

                //grab all parts based on a / separator
                $parts = explode('/',self::$callbacks[$key]);

                //collect the last index of the array
                $last = end($parts);

                //grab the controller name and method call
                $segments = explode('@',$last);

                //instanitate controller
                $controllerName = self::$baseNamespace.$segments[0];
                $controller = new $controllerName;

                //call method and pass any extra parameters to the method
                $methodName = $segments[1];
                $method = new \ReflectionMethod($controller, $methodName);
                $paramsCountDiff = $method->getNumberOfRequiredParameters() - count($realMatched);
                if ($paramsCountDiff > 0) {
                  for ($i=0; $i < $paramsCountDiff; $i++) { 
                    $realMatched[] = NULL;
                  }
                }
                $return = call_user_func_array([$controller, $methodName], $realMatched);
              } else {
                $closureFunction = new \ReflectionFunction(self::$callbacks[$key]);
                $paramsCountDiff = $closureFunction->getNumberOfRequiredParameters() - count($realMatched);
                if ($paramsCountDiff > 0) {
                  for ($i=0; $i < $paramsCountDiff; $i++) { 
                    $realMatched[] = NULL;
                  }
                }
                $return = call_user_func_array(self::$callbacks[$key], $realMatched);
              }

              // call View processor
              if ($after) {
                $after_segments = explode('@', $after);
                $after_segments[0]::{$after_segments[1]}($return);
              }

            }
          }
        }
      }
    }

    // run the error callback if the route was not found
    if ($routeMatch == false) {
      if (!self::$error_callback) {
        self::$error_callback = function() {
          header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
          echo '404';
        };
      }
      call_user_func(self::$error_callback);
    }
  }

  // detect true URI, inspired by CodeIgniter 2
  private static function detect_uri()
  {
    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
      $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
    } elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
      $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
    }
    if ($uri == '/' || empty($uri)) {
      return '/';
    }
    $uri = parse_url($uri, PHP_URL_PATH);
    if ($uri === NULL) {
      return '/';
    }
    return str_replace(array('//', '../'), '/', trim($uri, '/'));
  }
}