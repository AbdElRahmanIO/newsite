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

}


?>
