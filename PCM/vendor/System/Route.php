<?php

namespace System;

class Route {

  private $app;
  private $routes = [];
  private $notFound;

  public function __construct(Application $app)
  {
    $this->app = $app;
  }

  public function routes($value='')
  {
    return $this->routes;
  }

  public function add($url, $action, $requestMethod = 'Get')
  {
    $route = [
      'url' => $url,
      'pattern' => $this->generatePattern($url),
      'action' => $this->getAction($action),
      'method' => strtoupper($requestMethod),
    ];
    $this->routes[] = $route;
  }

  public function notFound($url)
  {
    $this->notFound = $url;
  }

  public function getProperRoute()
  {
    // echo $this->app->request->url();
    // die();
    foreach ($this->routes as $route) {
      if ($this->isMatching($route['pattern']) AND $this->isMatchingRequestMethod($route['method'])) {
        // /echo $route['pattern'];
        $arguments = $this->getArgumentsFrom($route['pattern']);
        list($controller, $method) = explode('@', $route['action']);
        return [$controller, $method, $arguments];
      }
    }
    return $this->app->url->redirectTo($this->notFound);
  }

  private function isMatching($pattern)
  {
    return preg_match($pattern, $this->app->request->url());
  }

  private function isMatchingRequestMethod($routeMethod)
  {
    return $routeMethod == $this->app->request->method();
  }

  private function getArgumentsFrom($pattern)
  {
    preg_match($pattern, $this->app->request->url(), $matches);
    //pre($matches);
    array_shift($matches);
    return $matches;
  }

  private function generatePattern($url)
  {
    $pattern = '#^';
    $pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9-]+)', '(\d+)'], $url);
    $pattern .= '$#';
    return $pattern;
  }

  private function getAction($action)
  {
    $pattern = str_replace('/', '\\', $action);
    return strpos($action, '@') !== false ? $action : $action . '@index';
  }

}

?>
