<?php

namespace System;

abstract class controller
{

  protected $app;

  protected $errors = [];

  public function __construct(application $app)
  {
    $this->app = $app;
  }

  public function json($data)
  {
    return json_encode($data);
  }

  public function __get($key)
  {
    return $this->app->get($key);
  }

}


?>
