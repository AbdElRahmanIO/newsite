<?php

namespace App\Controllers\Admin;

use System\Controller;

/**
 *
 */
class CategoriesController extends Controller
{

  public function index()
  {
    $this->html->setTitle('categories');
    $data['categories'] = $this->load->model('categories')->all();
    $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;
    $view = $this->view->render('admin/categories/list', $data);
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
      $this->load->model('categories')->create();
      $json['success'] = 'category has been created successfully';
      $json['redirectTo'] = $this->url->link('/admin/categories');
    }else {
      // $json['errors'] = $this->validator->getMessages();
      // $json['errors'] = implode('<br>', $this->validator->getMessages());
      $json['errors'] = $this->validator->flattenMessages();
    }
    return $this->json($json);
  }

  public function edit($id)
  {
    $categoriesModel = $this->load->model('categories');
    if (! $categoriesModel->exists($id)) {
      return $this->url->redirectTo('/404');
    }
    $category = $categoriesModel->get($id);
    //$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
    //pred($data['errors']);
    //$this->html->setTitle('Edit (' . $data['category']->name . ') Player');
      //echo $id;
      //pre($id);
      //$view =  $this->view->render('admin/categories/update-form', $data);
      return $this->form($category);
      // return $this->view->render('admin/categories/form', $data);
      //return $this->adminLayout->render($view);
  }

  private function form($category = null)
  {
    if ($category) {
      $data['target'] = 'editcat-' . $category->id;
      $data['action'] = $this->url->link('/admin/categories/save/' . $category->id);
      $data['heading'] = 'Edit ' . $category->name . 'player';
    }else {
      $data['target'] = 'addcat';
      $data['action'] = $this->url->link('/admin/categories/submit');
      $data['heading'] = 'Add New Player';
    }
    $data['name'] = $category ? $category->name : null;
    $data['status'] = $category ? $category->status : 'enabled';
    return $this->view->render('/admin/categories/form', $data);
  }

  public function save($id)
  {
    $json = [];
    if ($this->isValid()) {
      $this->load->model('categories')->update($id);
      $json['success'] = 'category has been Updated successfully';
      $json['redirectTo'] = $this->url->link('/admin/categories');
    }else {
      // $json['errors'] = $this->validator->getMessages();
      // $json['errors'] = implode('<br>', $this->validator->getMessages());
      $json['errors'] = $this->validator->flattenMessages();
    }
    return $this->json($json);
  }

  public function delete($id)
  {
    $categoriesModel = $this->load->model('categories');
    if (! $categoriesModel->exists($id)) {
      return $this->url->redirectTo('/404');
    }
    $categoriesModel->delete($id);
    // $this->session->set('success', 'player has been Done');
    // return $this->url->redirectTo('/admin/categories');
    $json['success'] = 'player has been deleted successfully';
    return $this->json($json);
  }

  private function isValid()
  {
    $this->validator->required('catname', 'category name is required');
    return $this->validator->passes();
  }

}


?>
