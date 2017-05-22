<?php

namespace System;
// use System\File;
use Closure;

class Application {

  private $container = [];
  private static $instance;
  public $file;
  private function __construct(File $file){
    $this->file = $file;
    $this->share('file', $file);
    $this->registerClasses();
    //static::$instance = $this;
    $this->loadHelpers();
    //pre($this->file);
  }

  public static function getInstance($file = null)
  {
    if (is_null(static::$instance)) {
      static::$instance = new static($file);
    }
    return static::$instance;
  }

  public function run()
  {
    $this->session->start();
    $this->request->prepareUrl();
    $this->file->call('App/index.php');
    //$this->route->getProperRoute();
    list($controller, $method, $arguments) = $this->route->getProperRoute();
    //$this->load->controller($controller);
    $output = (string) $this->load->action($controller, $method, $arguments);
    //pre($output);
    $this->response->setOutput($output);
    $this->response->send();
  }

  private function registerClasses(){
    spl_autoload_register([$this, 'load']);
  }

  public function load($class){
    if(strpos($class, 'App') === 0){
      $file = $class . '.php';
    }else{
      $file = 'vendor/' .  $class . '.php';
    }
    if($this->file->exists($file)) {
      $this->file->call($file);
    }
  }

  private function loadHelpers(){
    $this->file->call('vendor/helpers.php');
  }

  public function get($key){
    if (! $this->isSharing($key)) {
      if ($this->isCoreAlias($key)) {
        $this->share($key, $this->createNewCoreObject($key));
      }else {
        die('<b>' . $key . '</b> not found in Application container');
      }
    }
    //return $this->isSharing() ? $this->container[$key] : null;
    return $this->container[$key];
  }

  public function isSharing($key){
    return isset($this->container[$key]);
  }

  public function share($key, $value){
    if ($value instanceof Closure) {
      $value = call_user_func($value, $this);
    }
    $this->container[$key] = $value;
  }

  public function isCoreAlias($alias)
  {
    $coreClasses = $this->coreClasses();
    return isset($coreClasses[$alias]);
  }

  public function createNewCoreObject($alias)
  {
    $coreClasses = $this->coreClasses();
    $object = $coreClasses[$alias];
    return new $object($this);
  }

  public function coreClasses(){
    return [
      'request'   => 'System\\Http\\Request',
      'response'   => 'System\\Http\\Response',
      'session'   => 'System\\Session',
      'route'   => 'System\\Route',
      'cookie'   => 'System\\Cookie',
      'load'   => 'System\\Loader',
      'html'   => 'System\\Html',
      'db'   => 'System\\Database',
      'view'   => 'System\\View\\ViewFactory',
      'url'   => 'System\\Url',
      'validator'   => 'System\\Validation',
    ];
  }

  public function __get($key){
    return $this->get($key);
  }

}

?>
