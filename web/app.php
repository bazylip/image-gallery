<?php

// Controllers requires
require_once '../controllers/ImageController.php';
// Other requires
require_once '../Router.php';
require_once '../vendor/autoload.php';

$router = new Router();

$router->get('/image/add', 'ImageController::addImage');
$router->get('/image/errorSave', 'ErrorController::ErrorSave');
$router->get('/image/show', 'ImageController::showImage');
$router->get('/gallery', 'GalleryController::showSlice');
$router->post('/image/send', 'ImageController::sendImage');
$router->errors('404', 'ErrorController::Error404');

$view = $router->resolve();
$view->view();