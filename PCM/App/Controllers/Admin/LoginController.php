<?php

namespace App\Controllers\Admin;

use System\Controller;

/**
 *
 */
class LoginController extends Controller
{

  public function index()
  {
    // echo sha1(mt_rand(1, 100000) . time());
    // die();
    //pre($_COOKIE);
    $loginModel = $this->load->model('Login');
    if ($loginModel->isLogged()) {
      return $this->url->redirectTo('/admin');
    }
    $data['errors'] = $this->errors;
    return $this->view->render('admin/users/login', $data);

    // $this->db->data([
    //   'name'      => 'Abdelrahman',
    //   'email'     => 'abdelrahman.ui@gmail.com',
    //   'gender'    => 'male',
    //   'password'  => password_hash(123456, PASSWORD_DEFAULT),
    //   'created'   => time(),
    //   'status'    => 'enabled',
    // ])->insert('users');

    // pre($this->db->where('id=?', 1)->fetch('users'));
  }

  public function submit()
  {
    if ($this->isValid()) {
      // echo "valid";
      $loginModel = $this->load->model('Login');
      $loggedInUser = $loginModel->user();
      if ($this->request->post('remember')) {
        $this->cookie->set('login', $loggedInUser->code);
      }else {
        $this->session->set('login', $loggedInUser->code);
      }
      // return $this->url->redirectTo('/admin');
      $json = [];
      $json['success'] = 'Welcome Back <b style="color:black;">' . $loggedInUser->name . '</b> =)';
      $json['redirect'] = $this->url->link('/admin');
      return $this->json($json);
      // /pre($loginModel->user());
    }else {
      // pre($this->errors);
      // return $this->index();
      $json = [];
      $json['errors'] = implode('<br>', $this->errors);
      return $this->json($json);
    }
  }

  private function isValid()
  {
    $email = $this->request->post('email');
    $password = $this->request->post('password');

    if (! $email) {
      $this->errors[] = 'Please Insert Email';
    }elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = 'Please Insert Validate Email';
    }

    if (! $password) {
      $this->errors[] = 'Please insert Password';
    }

    if (! $this->errors) {
      $loginModel = $this->load->model('Login');
      if (! $loginModel->isValidLogin($email, $password)) {
        $this->errors[] = 'invalid Login Data';
      }
    }

    return empty($this->errors);
  }

}


?>
