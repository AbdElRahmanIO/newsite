<?php

namespace App\Controllers\Admin;

use System\Controller;

/**
 *
 */
class AccessController extends Controller
{

  public function index()
  {
    $loginModel = $this->load->model('Login');
    $ignorePages = ['/admin/login', '/admin/login/submit'];

    if (! $loginModel->isLogged() AND ! in_array($this->request->url(), $ignorePages)) {
      return $this->url->redirectTo('/admin/login');
    }
  }

}


?>
