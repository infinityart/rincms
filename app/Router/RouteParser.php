<?php
/**
 * Class RouteParser.php
 *
 * Parse the given route to a correct format.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 18/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Router;

class RouteParser
{
    /** @var Route */
    private $route;

    /**
     * RouteParser constructor.
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Parse the route to a Route object.
     *
     * @param array $route
     * @return Route
     * @throws \Exception
     */
    public function parseToObject(array $route) : Route
    {
        if(!preg_match('/@/', $route[2])){
            throw new \Exception('Route doesn\'t have the correct format!');
        }

        $routeInfo = preg_split('/@/', $route[2]);

        $this->route->class = $routeInfo[0];
        $this->route->method = $routeInfo[1];

        return $this->route;
    }

}