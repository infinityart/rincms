<?php
/**
 * @author: Jonty Sponselee <jsponselee96@gmail.com>
 * @since: 3/17/2019
 */

require_once '../vendor/autoload.php';

// Determine if the requested page is an admin page or a userview page

// For admin:
    // Login (system where a user can log into the admin section):
    // Determine if the user is logged in, otherwise show the login page
    // If the user is logged in, redirect the user to the requested page or the dashboard
    // Or show the 404 Admin page if the requested page isn't found

    // Manage Page (pages are dynamically made and shown to the client):
    // Actions: add, edit, delete, list

    // Manage Post ()

// For userview:
    // Show the content of the current page
    // Or show the 404 page if the requested page isn't found

// Goal: CMS where admin can manage pages and users can view said pages

$request = new \RinCMS\Http\Request(
    filter_input_array(INPUT_GET, FILTER_DEFAULT) ?: [],
    filter_input_array(INPUT_POST, FILTER_DEFAULT) ?: [],
    filter_input_array(INPUT_SERVER, FILTER_DEFAULT) ?: [],
    file_get_contents('php://input')
);
$response = new \RinCMS\Http\Response();
$templates = new \League\Plates\Engine('../app/site/views/');

$templates->setFileExtension('tpl');
$templates->addFolder('admin', '../app/admin/views/');

$routeCollection = include 'Router/routeCollection.php';

$router = new \RinCMS\Router\Router( new \RinCMS\Router\RouteParser( new \RinCMS\Router\Route()));

$router->addCollection($routeCollection);

$route = $router->route();

// todo:
// Add HTTP layer to the router
// Add path variables to the router

// ADMIN VIEW RENDERER
// ADMIN LOGIN

switch($router->status){
    case $router::NOT_FOUND:
        $response->setStatusCode(404);
        $response->setContent('Not Found');
        break;
    case $router::METHOD_NOT_ALLOWED:
        $response->setStatusCode(405);
//        $response->setContent('Method not alllowed');
        break;
    case $router::FOUND:
        $routeDispatcher = new \RinCMS\Router\RouteDispatcher($route);

        $routeDispatcher->dispatch($request, $response, $templates);
        break;
}

$response->sendHeaders();

echo $response->getContent();