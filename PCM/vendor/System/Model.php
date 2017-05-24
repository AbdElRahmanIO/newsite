<?php

namespace System;

abstract class Model
{

  protected $app;
  protected $table;

  public function __construct(application $app)
  {
    $this->app = $app;
  }

  public function __get($key)
  {
    return $this->app->get($key);
  }

  public function all()
  {
    return $this->fetchAll($this->table);
  }

  public function get($id)
  {
    return $this->where('id = ?', $id)->fetch($this->table);
  }

  public function exists($value, $key = 'id')
  {
    return (bool) $this->select($key)->where($key . '=?', $value)->fetch($this->table);
  }

  public function delete($id)
  {
      return $this->where('id = ?', $id)->delete($this->table);
  }

  public function __call($method, $args)
  {
    return call_user_func_array([$this->app->db, $method], $args);
  }

}


?>
