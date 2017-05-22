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
    //pre($_COOKIE);
    $this->validator->required('email')->email('email')->unique('email', ['users', 'email']);
    $this->validator->required('password')->minLen('password', 8);
    $this->validator->match('password', 'confirmPassword');
    pre($this->validator->getMessages());
  }

}


?>
