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

class RouteDispatcher
{
    /** @var Route */
    private $Route;

    /**
     * RouteDispatcher constructor.
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->Route = $route;
    }

    /**
     * Dispatch the route.
     *
     * @throws \Exception
     */
    public function dispatch()
    {
        if(!class_exists($this->Route->class))
        {
            throw new \Exception('Controller class doesn\'t exists!');
        }

        $object = new $this->Route->class;
        $method = $this->Route->method;

        if (!method_exists($object, $method)) {
            throw new \Exception('Controller method doesn\'t exists!');
        }

        $object->$method();
    }
}