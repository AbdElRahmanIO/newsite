<?php

namespace System\View;

use System\File;

/**
 *
 */
class View implements ViewInterface
{

  private $file;

  private $viewPath;

  private $data = [];

  private $output;

  public function __construct(File $file, $viewPath, array $data)
  {
    $this->file = $file;
    $this->preparePath($viewPath);
    $this->data = $data;
  }

  private function preparePath($viewPath)
  {
    $relativeViewPath = 'App/Views/' . $viewPath . '.php';
    $this->viewPath = $this->file->to($relativeViewPath);
    //echo $this->viewPath;
    if (! $this->viewFileExists($relativeViewPath)) {
      die('<b> ' . $viewPath . ' View</b> doesn\'t exists in view folder');
    }
  }

  private function viewFileExists($viewPath)
  {
    return $this->file->exists($viewPath);
  }

  public function getOutPut()
  {
    if (is_null($this->output)) {
      ob_start();
      //$myName = 'abdo2';
      extract($this->data);
      require $this->viewPath;
      $this->output = ob_get_clean();
    }
    return $this->output;
  }

  public function __toString()
  {
    return $this->getOutPut();
  }

}


?>
