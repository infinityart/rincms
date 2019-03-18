<?php
/**
 * Class RouteParser.php
 *
 * Parse the given route to a correct format.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 18/03/2019
 * @version 0.1 18/03/2019 Initial class definition.
 */
declare(strict_types=1);

namespace RinCMS\Router;

class RouteParser
{
    /** @var Route */
    private $Route;

    /**
     * RouteParser constructor.
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->Route = $route;
    }

    /**
     * Parse the route to a Route object.
     *
     * @param array $route
     * @return Route
     * @throws \Exception
     */
    public function parseToObject(array $route)
    {
        if(!preg_match('/@/', $route[2])){
            throw new \Exception('Route doesn\'t have the correct format!');
        }

        $routeInfo = preg_split('/@/', $route[2]);

        $this->Route->class = $routeInfo[0];
        $this->Route->method = $routeInfo[1];

        return $this->Route;
    }

}