<?php

// Controllers requires
require_once '../controllers/ImageController.php';
// Other requires
require_once '../Router.php';
require_once '../vendor/autoload.php';

$router = new Router();

session_start();

$router->get('/image/add', 'ImageController::addImage');
$router->get('/image/errorSave', 'ErrorController::ErrorSaveImage');
$router->get('/image/show', 'ImageController::showImage');
$router->get('/gallery', 'GalleryController::showSlice');
$router->get('/user/register', 'UserController::register');
$router->get('/user/login', 'UserController::login');
$router->get('/user/added', 'UserController::added');
$router->get('/user/addError', 'ErrorController::ErrorAddUser');
$router->get('/user/logged', 'UserController::logged');
$router->get('/gallery/selected', 'GalleryController::showSelected');
$router->post('/image/send', 'ImageController::sendImage');
$router->post('/user/add', 'UserController::addUser');
$router->post('/session/saveChoice', 'SessionController::saveChoice');
$router->post('/session/forgetChoice', 'SessionController::forgetChoice');
$router->post('/user/login/status', 'UserController::loginCheck');
$router->errors('404', 'ErrorController::Error404');

$view = $router->resolve();
$view->view();