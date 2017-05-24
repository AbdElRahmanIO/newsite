<?php

namespace App\Controllers\Admin;

use System\Controller;

/**
 *
 */
class DashboardController extends Controller
{

  public function index()
  {
    return $this->view->render('admin/main/dashboard');
  }

  public function submit()
  {
    $json['name'] = $this->request->post('fullName');
    return $this->json($json);
    //pre($_COOKIE);
    // pre($_POST);
    // pre($_FILES);
    $this->validator->required('email')->email('email')->unique('email', ['users', 'email']);
    $this->validator->required('password')->minLen('password', 8);
    $this->validator->match('password', 'confirmPassword');
    $file = $this->request->file('image');
    //pre($this->validator->getMessages());
    //echo $file->isImage();
    if ($file->isImage()) {
      echo $file->moveTo($this->file->to('public/images'), 'abdo');
    }
  }

}


?>
