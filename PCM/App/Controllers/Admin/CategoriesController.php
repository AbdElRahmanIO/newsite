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
    $view = $this->view->render('admin/categories/list');
    return $this->adminLayout->render($view);
  }

  public function add()
  {
    $data['action'] = $this->url->link('/admin/categories/submit');
    return $this->view->render('admin/categories/form', $data);
  }

  public function submit($value='')
  {
    $json['success'] = 'Done';
    return $this->json($json);
  }

}


?>
