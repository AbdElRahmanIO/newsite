<?php

namespace System;

class Cookie {

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }

  public function set($key, $value, $hours = 1800){
    // $_COOKIE[$key] = $value;
    setcookie($key, $value, time() + $hours * 3600, '', '', false, true);
  }

  public function get($key, $default = null){
    return array_get($_COOKIE, $key, $default);
  }

  public function has($key){
    // return isset($_COOKIE[$key]);
    return array_key_exists($key, $_COOKIE);
  }

  public function remove($key){
    setcookie($key, null, -1);
    unset($_COOKIE[$key]);
  }

  public function all(){
    return $_COOKIE;
  }

  public function destroy(){
    // session_destroy();
    foreach (array_keys($this->all()) as $key) {
      $this->remove($key);
    }
    unset($_COOKIE);
  }

}
