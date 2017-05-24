<?php

namespace APP\Models;

use System\Model;

/**
 *
 */
class CategoriesModel extends Model
{

  protected $table = 'players';

  public function create()
  {
    $this->data('name', $this->request->post('catname'))
         ->data('status', $this->request->post('status'))
         ->insert($this->table);
  }

  public function update($id)
  {
    $this->data('name', $this->request->post('catname'))
         ->data('status', $this->request->post('status'))
         ->where('id=?', $id)
         ->update($this->table);
  }

}


 ?>
