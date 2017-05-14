<?php

use System\Application;

$app = Application::getInstance();

//pre($app);

$app->route->add('/', 'Home', 'POST');

$app->route->add('/Projects/:text/:id', 'Projects/Project');

$app->route->add('/404', 'Error/NotFound');

$app->route->notFound('/404');

?>
