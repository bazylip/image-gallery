<?php

// Controllers requires
require_once '../controllers/ImageController.php';
// Other requires
require_once '../Router.php';

$router = new Router();
$router->get('/image/add', 'ImageController::addImage');

$view = $router->dispatch();
$view->render();