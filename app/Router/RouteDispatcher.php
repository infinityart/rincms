<?php
/**
 * Class RouteDispatcher.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 19/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Router;

use League\Plates\Engine;
use RinCMS\Http\Request;
use RinCMS\Http\Response;

class RouteDispatcher
{
    /** @var Route */
    private $route;

    /**
     * RouteDispatcher constructor.
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Dispatch the route.
     *
     * @param Request $request
     * @param Response $response
     * @param Engine $templates
     * @throws \Exception
     */
    public function dispatch(Request $request, Response $response, Engine $templates): void
    {
        if(!class_exists($this->route->class))
        {
            throw new \Exception('Controller class doesn\'t exists!');
        }

        $object = new $this->route->class($request, $response, $templates);
        $method = $this->route->method;

        if (!method_exists($object, $method)) {
            throw new \Exception('Controller method doesn\'t exists!');
        }

        $object->$method();
    }
}