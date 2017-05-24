<?php

namespace System\Http;

class Request {

  private $url;

  private $baseUrl;

  private $files = [];

  public function prepareUrl(){
    //pre($_SERVER);
    //echo $this->server('SCRIPT_NAME');
    $script = dirname($this->server('SCRIPT_NAME'));
    //echo $script;
    $requestUri = $this->server('REQUEST_URI');
    //echo $requestUri;
    if (strpos($requestUri, '?') !== false) {
      list($requestUri, $queryString) = explode('?', $requestUri);
    }
    //echo $requestUri;
    //$requestUri = preg_replace('#^' . $script . '#', '', $requestUri);
    //echo $requestUri;
    $this->url = rtrim(preg_replace('#^' . $script . '#', '', $requestUri), '/');
    //echo $this->url;
    //pre($_SERVER);
    if (! $this->url) {
      $this->url =  '/';
    }
    $this->baseUrl = $this->server('REQUEST_SCHEME') . '://' . $this->server('HTTP_HOST') . $script . '/';
    //echo $this->baseUrl;

  }

  public function get($key, $default = null)
  {
    return array_get($_GET, $key, $default);
  }

  public function post($key, $default = null)
  {
    return array_get($_POST, $key, $default);
  }

  public function file($input)
  {
    if (isset($this->file[$input])) {
      return $this->files[$input];
    }
    $uploadedFile = new UploadedFile($input);
    $this->files[$input] = $uploadedFile;
    return $this->files[$input];
  }

  public function server($key, $default = null)
  {
    return array_get($_SERVER, $key, $default);
  }

  public function method()
  {
    return $this->server('REQUEST_METHOD');
  }

  public function baseUrl()
  {
    return $this->baseUrl;
  }

  public function url()
  {
    return $this->url;
  }

}

?>
