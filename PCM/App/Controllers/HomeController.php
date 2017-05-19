<?php

namespace App\Controllers;

use System\Controller;

/**
 *
 */
class HomeController extends Controller
{

  public function index()
  {
    echo assets('images/logo.png');
    // echo $this->url->link('/home');
    // echo $this->url->link('/project/20');
    // echo $this->url->redirectTo('/project/20');
    // $users = $this->load->model('users');
    // pre($users->get(2));
    // $users = $this->db->select('*')->from('users')->orderBy('id', 'DESC')->fetch();
    // $users = $this->db->select('*')->from('users')->orderBy('id')->fetch();
    // $userss = $this->db->select('*')->from('users')->where('id > ? AND id < ?', 1, 4)->orderBy('id', 'DESC')->fetchAll();
    //$this->db->where('id > ?', 2)->delete('users');
    //pre($userss);
    // pre($this->db->where('id != ?', 2)->fetchAll('users'));
    // echo $this->db->rows();
    // pre($this->db->fetchAll('users'));
    // $this->db>select('name,email');
    // $this->db->data('name', 'abdo ahmad')
    //         //  ->where('id = ?', 1)
    //          ->update('users');
    /*
    echo $this->db->data([
      'email'    => 'abdo',
      'image'     => '<b>welcom</b>',
    ])->insert('users')->lastId();
    $user = $this->db->query('SELECT * FROM users WHERE id =?', 9)->fetch();
    pre($user);
    $this->db->query('INSERT INTO users SET email=?, status=?', 'abdelrahman.ui@gmail.com', 'enable');
    echo phpinfo();
    $this->response->setHeader('name', 'abdo');
    $data['myName'] = 'Abdo';
    echo "welcome";
    echo $this->request->url();
    $this->session->set('name', 'Abdo');
    echo $this->session->get('name');
    return $this->view->render('home', $data);
    pre($view);
    echo $view;*/
  }

}


?>
