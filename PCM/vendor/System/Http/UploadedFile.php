<?php

namespace System\Http;

use System\Application;

/**
 *
 */
class UploadedFile
{

  private $app;
  private $file = [];
  private $fileName;
  private $nameOnly;
  private $extension;
  private $mimeType;
  private $tempFile;
  private $size;
  private $error;
  private $allawedImageExtensions = ['gif', 'jpg', 'jpeg', 'png'];

  public function __construct(/*Application $app, */$input)
  {
    // $this->app = $app;
    $this->getFileInfo($input);
  }

  private function getFileInfo($input)
  {
    if (empty($_FILES[$input])) {
      return;
    }
    $file = $_FILES[$input];
    $this->error = $file['error'];
    if ($this->error != UPLOAD_ERR_OK) {
      return;
    }
    $this->file = $file;
    //pre($this->file);
    $this->fileName = $this->file['name'];
    //pre(pathinfo($this->fileName));
    $fileNameInfo = pathinfo($this->fileName);
    $this->nameOnly = $fileNameInfo['basename'];
    $this->extension = strtolower($fileNameInfo['extension']);
    $this->mimeType = $this->file['type'];
    $this->tempFile = $this->file['tmp_name'];
    $this->size = $this->file['size'];
  }

  public function exists()
  {
    return ! empty($this->file);
  }

  public function getFileName()
  {
    return $this->fileName;
  }

  public function getNameOnly()
  {
    return $this->nameOnly;
  }

  public function getExtension()
  {
    return $this->extension;
  }

  public function getMimeType()
  {
    return $this->mimeType;
  }

  public function isImage()
  {
    return strpos($this->mimeType, 'image/') === 0 AND in_array($this->extension, $this->allawedImageExtensions);
  }

  public function moveTo($target, $newFileName = null)
  {
    $fileName = $newFileName ?: sha1(mt_rand()) . '_' . sha1(mt_rand());
    $fileName .= '.' . $this->extension;
    //echo $fileName;
    //echo $target;
    if (! is_dir($target)) {
      mkdir($target, 0777, true);
    }
    $uploadFilePath = rtrim($target,'/') . '/ ' . $fileName;
    move_uploaded_file($this->tempFile, $uploadFilePath);
    return $fileName;
  }

}


 ?>
