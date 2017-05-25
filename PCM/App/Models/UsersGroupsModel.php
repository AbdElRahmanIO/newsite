<?php

namespace APP\Models;

use System\Model;

/**
 *
 */
class UsersGroupsModel extends Model
{

  protected $table = 'users_groups';

  public function get($id)
  {
    $usersGroup = parent::get($id);
    if ($usersGroup) {
      $pages = $this->select('page')->where('users_group_id = ?', $usersGroup->id)->fetchAll('users_group_permissions');
      $usersGroup->pages = [];
      if ($pages) {
        foreach ($pages as $page) {
          $usersGroup->pages[] = $page->page;
        }
      }
    }
    return $usersGroup;
  }

  public function create()
  {
    $usersGroupsId = $this->data('name', $this->request->post('groupname'))
                           //->data('status', $this->request->post('status'))
                          ->insert($this->table)->lastId();
    $pages = array_filter($this->request->post('pages'));
    foreach ($pages as $page) {
      $this->data('users_group_id', $usersGroupsId)
           ->data('page', $page)
           ->insert('users_group_permissions');
    }
  }

  public function update($id)
  {
    $this->data('name', $this->request->post('groupname'))
         //->data('status', $this->request->post('status'))
         ->where('id=?', $id)
         ->update($this->table);
  }

}


 ?>
