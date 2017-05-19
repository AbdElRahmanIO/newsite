<?php

namespace APP\Models;

use System\Model;

/**
 *
 */
class LoginModel extends Model
{

  protected $table = 'users';



  public function isValidLogin($email, $password)
  {
    $user = $this->where('email =?', $email)->fetch($this->table);
    if (! $user) {
      return false;
    }
    $this->user =  $user;
    //pre($user);
    return password_verify($password, $user->password);
  }

  public function user()
  {
    return $this->user;
  }

  public function isLogged()
  {
    if ($this->cookie->has('login')) {
      $code = $this->cookie->get('login');
      // $user = $this->where('code=?', $this->cookie->get('login'))->fetch($this->table);
    }elseif ($this->session->has('login')) {
      // $user = $this->where('code=?', $this->session->get('login'))->fetch($this->table);
      $code = $this->session->get('login');
    }else {
      $code = '';
    }
    $user = $this->where('code=?', $code)->fetch($this->table);
    if (! $user) {
      return false;
    }
    $this->user = $user;
    return true;
  }

}


 ?>
