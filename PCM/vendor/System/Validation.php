<?php

namespace System;

class Validation
{

  private $app;
  private $errors = [];

  public function __construct(Application $app){
    $this->app = $app;
  }

  public function required($inputName, $customErrorMessage = null)
  {
    if ($this->hasErrors($inputName)) {
      return $this;
    }
    $inputValue = $this->value($inputName);
    if ($inputValue === '') {
      $message = $customErrorMessage ?: sprintf('%s is required', ucfirst($inputName));
      $this->addError($inputName, $message);
    }
    return $this;
  }

  public function email($inputName, $customErrorMessage = null)
  {
    //pre($this->errors);
    if ($this->hasErrors($inputName)) {
      return $this;
    }
    $inputValue = $this->value($inputName);
    if (! filter_var($inputValue, FILTER_VALIDATE_EMAIL)) {
      $message = $customErrorMessage ?: sprintf('%s is not valid email', ucfirst($inputName));
      $this->addError($inputName, $message);
    }
    return $this;
  }

  public function float($inputName, $customErrorMessage = null)
  {
    if ($this->hasErrors($inputName)) {
      return $this;
    }
    $inputValue = $this->value($inputName);
    if (! is_float($inputValue)) {
      $message = $customErrorMessage ?: sprintf('%s accepts only floats', ucfirst($inputName));
      $this->addError($inputName, $message);
    }
    return $this;
  }

  public function minLen($inputName, $length, $customErrorMessage = null)
  {
    if ($this->hasErrors($inputName)) {
      return $this;
    }
    $inputValue = $this->value($inputName);
    if (strlen($inputValue) < $length) {
      $message = $customErrorMessage ?: sprintf('%s should be at least %d', ucfirst($inputName), $length);
      $this->addError($inputName, $message);
    }
    return $this;
  }

  public function maxLen($inputName, $customErrorMessage = null)
  {
    if ($this->hasErrors($inputName)) {
      return $this;
    }
    $inputValue = $this->value($inputValue);
    if (strlen($inputValue) > $length) {
      $message = $customErrorMessage ?: sprintf('%s should be at most %d', ucfirst($inputName), $length);
      $this->addError($inputName, $message);
    }
    return $this;
  }

  public function match($firstInput, $secondInput, $customErrorMessage = null)
  {
    $firstInputValue = $this->value($firstInput);
    $secondInputValue = $this->value($secondInput);
    if ($firstInputValue != $secondInputValue) {
      $message = $customErrorMessage ?: sprintf('%s should match %s', ucfirst($secondInput), ucfirst($firstInput));
      $this->addError($secondInput, $message);
    }
    return $this;
  }

  public function unique($inputName, array $databaseData, $customErrorMessage = null)
  {
    if ($this->hasErrors($inputName)) {
      return $this;
    }
    $inputValue = $this->value($inputName);
    $table = null;
    $column = null;
    $exceptionColumn = null;
    $exceptionColumnValue = null;
    if (count($databaseData) == 2) {
      list($table, $column) = $databaseData;
    }elseif (count($databaseData == 4)) {
      list($table, $column, $exceptionColumn, $exceptionColumnValue) = $databaseData;
    }
    if ($exceptionColumn AND $exceptionColumnValue) {
      $result = $this->app->db->select($column)
                              ->from($table)
                              ->where($column . ' = ? AND ' . $exceptionColumn . ' != ?' , $inputValue, $exceptionColumnValue)
                              ->fetch();
    }else {
      $result = $this->app->db->select($column)
                              ->from($table)
                              ->where($column . ' = ?' , $inputValue)
                              ->fetch();
    }
    if ($result) {
      $message = $customErrorMessage ?: sprintf('%s is already exists', ucfirst($inputName));
      $this->addError($inputName, $message);
    }
  }

  public function message($message)
  {
    $this->errors[] = $message;
    return $this;
  }

  // public function validate()
  // {
  //
  // }

  public function fails()
  {
    return ! empty($this->errors);
  }

  public function passes()
  {
    return empty($this->errors);
  }

  public function getMessages()
  {
    return $this->errors;
  }

  public function flattenMessages()
  {
    return implode('<br>', $this->errors);
  }

  private function value($input)
  {
      return $this->app->request->post($input);
  }

  private function addError($inputName, $errorMessage)
  {
    $this->errors[$inputName] = $errorMessage;
  }

  private function hasErrors($inputName)
  {
    return array_key_exists($inputName, $this->errors);
  }

}

?>
