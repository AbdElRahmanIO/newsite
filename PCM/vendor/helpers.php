<?php

use System\Application;

if (! function_exists('pre')){

    function pre($var){

      echo "<pre>";
      print_r($var);
      echo "<pre>";

    }

}

if (! function_exists('pred')) {
  function pred($var)
  {
    pre($var);
    die;
  }
}

if (! function_exists('array_get')) {
  function array_get($array, $key, $default = null){
    return isset($array[$key]) ? $array[$key] : $default;
  }
}

if (! function_exists('_e')) {
  function _e($value)
  {
    return htmlspecialchars($value);
  }
}

if (! function_exists('assets')) {
  function assets($path)
  {
    // global $app;
    // return $app->url->link('public/' . $path);
    $app = Application::getInstance();
    return $app->url->link('public/' . $path);
  }
}

if (! function_exists('url')) {
  function url($path)
  {
    // global $app;
    // return $app->url->link('public/' . $path);
    $app = Application::getInstance();
    return $app->url->link($path);
  }
}





?>
