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

  public function action($controller, $method, array $arguments = [])
  {
    $object = $this->controller($controller);
    return call_user_func_array([$object, $method], $arguments);
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

  /* Model */

  public function model($model)
  {
    $model = $this->getModelName($model);
    //echo $controller;
    if (! $this->hasModel($model)) {
      $this->addModel($model);
    }
    return $this->getModel($model);
  }

  private function hasModel($model)
  {
    return array_key_exists($model, $this->models);
  }

  private function addModel($model)
  {
    //echo 1;
    $object = new $model($this->app);
    $this->models[$model] = $object;
  }

  private function getModel($model)
  {
    return $this->models[$model];
  }

  private function getModelName($model)
  {
    $model .= 'Model';
    $model = 'App\\Models\\' . $model;
    //return $controller;
    return str_replace('/', '\\', $model);
  }

}


?>
