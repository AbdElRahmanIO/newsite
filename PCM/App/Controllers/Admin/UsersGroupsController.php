<?php

namespace App\Controllers\Admin;

use System\Controller;

/**
 *
 */
class UsersGroupsController extends Controller
{

  public function index()
  {
    //$this->getPermissionPages();
    $this->html->setTitle('Users Groups');
    $data['users_groups'] = $this->load->model('UsersGroups')->all();
    $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;
    $view = $this->view->render('admin/users-groups/list', $data);
    return $this->adminLayout->render($view);
  }

  public function add()
  {
    // return $this->view->render('admin/categories/form', $data);
    return $this->form();
  }

  public function submit()
  {
    // $json['success'] = 'Done';
    $json = [];
    if ($this->isValid()) {
      $this->load->model('UsersGroups')->create();
      $json['success'] = 'Users Group has been created successfully';
      $json['redirectTo'] = $this->url->link('/admin/users-groups');
    }else {
      // $json['errors'] = $this->validator->getMessages();
      // $json['errors'] = implode('<br>', $this->validator->getMessages());
      $json['errors'] = $this->validator->flattenMessages();
    }
    return $this->json($json);
  }

  public function edit($id)
  {
    $usersGroupsModel = $this->load->model('UsersGroups');
    if (! $usersGroupsModel->exists($id)) {
      return $this->url->redirectTo('/404');
    }
    $usersGroup = $usersGroupsModel->get($id);
    //$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
    //pred($data['errors']);
    //$this->html->setTitle('Edit (' . $data['category']->name . ') Player');
      //echo $id;
      //pre($id);
      //$view =  $this->view->render('admin/categories/update-form', $data);
      return $this->form($usersGroup);
      // return $this->view->render('admin/categories/form', $data);
      //return $this->adminLayout->render($view);
  }

  private function form($usersGroup = null)
  {
    if ($usersGroup) {
      $data['target'] = 'editUsersGroup-' . $usersGroup->id;
      $data['action'] = $this->url->link('/admin/users-groups/save/' . $usersGroup->id);
      $data['heading'] = 'Edit ' . $usersGroup->name . 'player';
    }else {
      $data['target'] = 'addUsersGroup';
      $data['action'] = $this->url->link('/admin/users-groups/submit');
      $data['heading'] = 'Add New Users Groups';
    }
    $data['name'] = $usersGroup ? $usersGroup->name : null;
    $data['users_group_pages'] = $usersGroup ? $usersGroup->pages : [];
    //$data['status'] = $usersGroup ? $usersGroup->status : 'enabled';
    $data['pages'] = $this->getPermissionPages();
    return $this->view->render('/admin/users-groups/form', $data);
  }

  private function getPermissionPages()
  {
    $permession = [];
    foreach ($this->route->routes() as $route) {
      //pre($route);
      if (strpos($route['url'], '/admin') === 0) {
        $permession[] = $route['url'];
      }
    }
    // pred($permession);
    // die;
    return $permession;
  }

  public function save($id)
  {
    $json = [];
    if ($this->isValid()) {
      $this->load->model('UsersGroups')->update($id);
      $json['success'] = 'Users Group has been Updated successfully';
      $json['redirectTo'] = $this->url->link('/admin/users-groups');
    }else {
      // $json['errors'] = $this->validator->getMessages();
      // $json['errors'] = implode('<br>', $this->validator->getMessages());
      $json['errors'] = $this->validator->flattenMessages();
    }
    return $this->json($json);
  }

  public function delete($id)
  {
    $usersGroupsModel = $this->load->model('UsersGroups');
    if (! $usersGroupsModel->exists($id) OR $id == 1) {
      return $this->url->redirectTo('/404');
    }
    $usersGroupsModel->delete($id);
    // $this->session->set('success', 'player has been Done');
    // return $this->url->redirectTo('/admin/categories');
    $json['success'] = 'Users Group has been deleted successfully';
    return $this->json($json);
  }

  private function isValid()
  {
    $this->validator->required('name', 'Users Group name is required');
    return $this->validator->passes();
  }

}


?>
