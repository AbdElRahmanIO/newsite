<?php

namespace App\Controllers\Admin\Common;

use System\Controller;
use System\View\ViewInterface;

/**
 *
 */
class LayoutController extends Controller
{

  public function render(ViewInterface $view)
  {
    $data['content'] = $view;
    $data['header'] = $this->load->Controller('Admin/Common/Header')->index();
    $data['sidebar'] = $this->load->Controller('Admin/Common/Sidebar')->index();
    $data['footer'] = $this->load->Controller('Admin/Common/Footer')->index();
    return $this->view->render('admin/common/layout', $data);
  }

}


?>
