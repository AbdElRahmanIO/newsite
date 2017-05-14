<?php

namespace system;

/**
 *
 */
class Loader
{

  private $app;

  private $controllers = [];

  private $models = [];

  public function __construct(application $app)
  {
    $this->app = $app;
  }

  public function action($controller, $method, array $arguments)
  {
    $object = $this->controller($controller);
    return call_user_func([$object, $method], $arguments);
  }

  public function controller($controller)
  {
    $controller = $this->getControllerName($controller);
    //echo $controller;
    if (! $this->hasController($controller)) {
      $this->addController($controller);
    }
    return $this->getController($controller);
    //return str_replace('/', '\\', $controller);
  }

  private function hasController($controller)
  {
    return array_key_exists($controller, $this->controllers);
  }

  private function addController($controller)
  {
    //echo 1;
    $object = new $controller($this->app);
    $this->controllers[$controller] = $object;
  }

  private function getController($controller)
  {
    return $this->controllers[$controller];
  }

  private function getControllerName($controller)
  {
    $controller .= 'Controller';
    $controller = 'App\\Controllers\\' . $controller;
    //return $controller;
    return str_replace('/', '\\', $controller);
  }

  public function model($model)
  {
    # code...
  }

  private function hasModel($model)
  {
    # code...
  }

  private function addModel($model)
  {
    # code...
  }

  private function getModel($model)
  {
    # code...
  }

}


?>
