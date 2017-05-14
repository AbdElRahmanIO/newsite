<?php

namespace System;

use PDO;

use PDOException;

class Database
{

  private $app;

  private static $connection;

  private $table;

  private $data = [];

  private $bindings = [];

  private $lastId;

  private $wheres = [];

  private $selects = [];

  private $limit;

  private $offset;

  private $joins = [];

  private $orderBy = [];



  public function __construct(application $app)
  {
    $this->app = $app;
    if (! $this->isConnected()) {
      $this->connect();
    }
  }

  private function isConnected()
  {
    return static::$connection instanceof PDO;
  }

  private function connect()
  {
    $connectionData = $this->app->file->call('config.php');
    //pre($connectionData);
    // static::$connection = new PDO('mysql:host =' . $connectionData['server'] . ';dbname = ' . $connectionData['dbname'], $connectionData['dbuser'], $connectionData['dbpass']);
    extract($connectionData);
    try {
      // static::$connection = new PDO('mysql:host =' . $server . ';dbname = ' . $dbname, $dbuser, $dbpass);
      static::$connection = new PDO("mysql:host=$server;dbname=$dbname", $dbuser, $dbpass);
      static::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      static::$connection->exec('SET NAMES utf8');
    } catch (PDOException $e) {
      die($e->getMessage());
    }
    //echo $this->isConnected();
  }

  public function connection()
  {
    return static::$connection;
  }

  public function from($table)
  {
    return $this->table($table);
  }

  public function select($select)
  {
    $this->selects[] = $select;
    return $this;
  }

  public function join($join)
  {
    $this->joins[] = $join;
    return $this;
  }

  public function orderBy($orderBy, $sort = 'ASC')
  {
    $this->orderBy = [$orderBy, $sort];
    return $this;
  }

  public function limit($limit, $offset = 0)
  {
    $this->limit = $limit;
    $this->offset = $offset;
    return $this;
  }

  public function fetch($table = null)
  {
    if ($table) {
      $this->table($table);
    }
    $sql = $this->fetchStatement();
    $result = $this->query($sql)->fetch();
    return $result;
  }

  public function fetchAll($table = null)
  {
    if ($table) {
      $this->table($table);
    }
    $sql = $this->fetchStatement();
    $results = $this->query($sql)->fetchAll();
    return $results;
  }

  private function fetchStatement()
  {
    $sql = 'SELECT ';
    if ($this->selects) {
      $sql .= implode(',', $this->selects);
    }else {
      $sql .= '*';
    }
    $sql .= ' FROM ' . $this->table . ' ';
    if ($this->joins) {
      $sql .= implode(' ', $this->joins);
    }
    if ($this->wheres) {
      $sql .= ' WHERE ' . implode(' ', $this->wheres);
    }
    if ($this->limit) {
      $sql .= ' LIMIT ' . $this->limit;
    }
    if ($this->offset) {
      $sql .= ' OFFSET ' . $this->offset;
    }
    if ($this->orderBy) {
      $sql .= 'ORDER BY ' . implode(' ', $this->orderBy);
    }
    return $sql;
  }

  public function table($table)
  {
    $this->table = $table;
    return $this;
  }

  public function data($key, $value = null)
  {
    if (is_array($key)) {
        $this->data = array_merge($this->data, $key);
        $this->addToBindings($key);
    }else {
        $this->data[$key] = $value;
        $this->addToBindings($value);
    }
    return $this;
  }

  public function insert($table = null)
  {
    if ($table) {
      $this->table($table);
    }
    $sql = 'INSERT INTO ' . $this->table . ' SET ';
    $sql = $this->setFields();
    //echo $sql;
    $this->query($sql, $this->bindings);
    $this->lastId = $this->connection()->lastInsertId();
    return $this;
  }

  public function update($table = null)
  {
    if ($table) {
      $this->table($table);
    }
    $sql = 'UPDATE ' . $this->table . ' SET ';
    $sql .= $this->setFields();
    // foreach (array_key_exists($this->data) as $key) {
    //   $sql .= '`' . $key . '` = ? , ';
    //   //$this->addToBindings($value);
    // }
    // $sql = rtrim($sql, ', ');
    if ($this->wheres) {
      $sql .= ' WHERE ' . implode(' ', $this->wheres);
    }
    //echo $sql;
    //pre($this->bindings);
    $this->query($sql, $this->bindings);
    //$this->lastId = $this->connection()->lastInsertId();
    return $this;
  }

  private function setFields()
  {
    $sql = '';
    foreach (array_keys($this->data) as $key) {
      $sql .= '`' . $key . '` = ? , ';
      //$this->addToBindings($value);
    }
    $sql = rtrim($sql, ', ');
    return $sql;
  }

  public function where()
  {
    $bindings = func_get_args();
    $sql = array_shift($bindings);
    $this->addToBindings($bindings);
    $this->wheres[] = $sql;
    return $this;
  }

  public function query()
  {
    $bindings = func_get_args();
    $sql = array_shift($bindings);
    if (count($bindings) == 1 AND is_array($bindings[0])) {
      $bindings = $bindings[0];
    }
    try {
      // $query = static::$connection->query($sql);
      $query = $this->connection()->prepare($sql);
      foreach ($bindings as $key => $value) {
        $query->bindValue($key + 1, _e($value));
      }
      $query->execute();
      //pre($query);
      return $query;
    } catch (PDOException $e) {
      echo $sql;
      pre($this->bindings);
      die($e->getMessage());
    }

  }

  public function lastId()
  {
    return $this->lastId;
  }

  // public function query(...$bindings){}

  private function addToBindings($value)
  {
    if (is_array($value)) {
      $this->bindings = array_merge($this->bindings, array_values($value));
    }else {
      $this->bindings[] = $value;
    }
  }

}


?>
