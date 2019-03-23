<?php
/**
 * The boot file of the application.
 *
 * @author: Jonty Sponselee <jsponselee96@gmail.com>
 * @since: 3/17/2019
 */

require_once '../vendor/autoload.php';

// HTTP layer
$request = new \RinCMS\Http\Request(
    filter_input_array(INPUT_GET, FILTER_DEFAULT) ?: [],
    filter_input_array(INPUT_POST, FILTER_DEFAULT) ?: [],
    filter_input_array(INPUT_SERVER, FILTER_DEFAULT) ?: [],
    file_get_contents('php://input')
);
$response = new \RinCMS\Http\Response();

// Template engine
$templates = new \League\Plates\Engine('../app/site/views/');

$templates->setFileExtension('tpl');
$templates->addFolder('admin', '../app/admin/views/');

// Router
$routeCollection = include 'Router/routeCollection.php';

$router = new \RinCMS\Router\Router( new \RinCMS\Router\RouteParser( new \RinCMS\Router\Route()));

$router->addCollection($routeCollection);

$route = $router->route();

switch($router->status){
    case $router::NOT_FOUND:
        $response->setStatusCode(404);
        break;
    case $router::METHOD_NOT_ALLOWED:
        $response->setStatusCode(405);
        break;
    case $router::FOUND:
        $routeDispatcher = new \RinCMS\Router\RouteDispatcher($route);

        $routeDispatcher->dispatch($request, $response, $templates);
        break;
}

$response->sendHeaders();

echo $response->getContent();