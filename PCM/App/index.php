<?php

use System\Application;

$app = Application::getInstance();
//
// //pre($app);
//
// $app->route->add('/', 'Home', 'POST');
//
// $app->route->add('/Projects/:text/:id', 'Projects/Project');

$app->route->add('/admin/login', 'Admin/Login');
$app->route->add('/admin/login/submit', 'Admin/Login@submit', 'POST');


$app->share('adminLayout', function($app){
  return $app->load->Controller('Admin/Common/Layout');
});


$app->route->add('/admin', 'Admin/Dashboard');
$app->route->add('/admin/dashboard', 'Admin/Dashboard');


$app->route->add('/admin/users', 'Admin/Users');
$app->route->add('/admin/users/add', 'Admin/Users@add');
$app->route->add('/admin/users/submit', 'Admin/Users@submit', 'POST');
$app->route->add('/admin/users/edit/:id', 'Admin/Users@edit');
$app->route->add('/admin/users/save/:id', 'Admin/Users@save', 'POST');
$app->route->add('/admin/users/delete/:id', 'Admin/Users@delete');


$app->route->add('/admin/users-groups', 'Admin/UsersGroups');
$app->route->add('/admin/users-groups/add', 'Admin/UsersGroups@add');
$app->route->add('/admin/users-groups/submit', 'Admin/UsersGroups@submit', 'POST');
$app->route->add('/admin/users-groups/edit/:id', 'Admin/UsersGroups@edit');
$app->route->add('/admin/users-groups/save/:id', 'Admin/UsersGroups@save', 'POST');
$app->route->add('/admin/users-groups/delete/:id', 'Admin/UsersGroups@delete');


$app->route->add('/admin/projects', 'Admin/Projects');
$app->route->add('/admin/projects/add', 'Admin/Projects@add');
$app->route->add('/admin/projects/submit', 'Admin/Projects@submit', 'POST');
$app->route->add('/admin/projects/edit/:id', 'Admin/Projects@edit');
$app->route->add('/admin/projects/save/:id', 'Admin/Projects@save', 'POST');
$app->route->add('/admin/projects/delete/:id', 'Admin/Projects@delete');
$app->route->add('/admin/projects/:id/comments', 'Admin/Comments');
$app->route->add('/admin/projects/comments/edit/:id', 'Admin/Comments@edit');
$app->route->add('/admin/projects/comments/save/:id', 'Admin/Comments@save', 'POST');
$app->route->add('/admin/projects/comments/delete/:id', 'Admin/Comments@delete');


$app->route->add('/admin/categories', 'Admin/Categories');
$app->route->add('/admin/categories/add', 'Admin/Categories@add');
$app->route->add('/admin/categories/submit', 'Admin/Categories@submit', 'POST');
$app->route->add('/admin/categories/edit/:id', 'Admin/Categories@edit');
$app->route->add('/admin/categories/save/:id', 'Admin/Categories@save', 'POST');
$app->route->add('/admin/categories/delete/:id', 'Admin/Categories@delete');


$app->route->add('/admin/settings', 'Admin/Settings');
$app->route->add('/admin/settings/save', 'Admin/Settings@save', 'POST');


$app->route->add('/admin/contacts', 'Admin/Contacts');
$app->route->add('/admin/contacts/reply/:id', 'Admin/Contacts@reply');
$app->route->add('/admin/contacts/send/:id', 'Admin/Contacts@send', 'POST');


$app->route->add('/logout', 'Admin/Logout');


$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');

?>
