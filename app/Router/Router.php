<?php
/**
 * Class router.php
 *
 * Resolve the route of the collection
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 17/03/2019
 * @version 0.1 17/03/2019 Initial class definition.
 */
declare(strict_types=1);

namespace RinCMS\Router;

class Router
{
    const NOT_FOUND = 0;
    const FOUND = 1;
    const METHOD_NOT_ALLOWED = 2;

    /** @var array */
    private $routeCollection;

    /** @var string */
    private $requestUri;

    /** @var string */
    private $requestMethod;

    /** @var RouteParser */
    private $RouteParser;

    /** @var int */
    public $status;

    /**
     * Router constructor.
     * @param RouteParser $RouteParser
     */
    public function __construct(RouteParser $RouteParser)
    {
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->RouteParser = $RouteParser;
    }

    /**
     * Add the route collection.
     *
     * @param array $routeCollection
     */
    public function addCollection(array $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    /**
     * Give route data back to the corresponding request.
     *
     * @return Route|null
     * @throws \Exception
     */
    public function route()
    {
        if(!$route = $this->findMatch()) {
            return false;
        }

        return $this->RouteParser->parseToObject($route);
    }

    /**
     * Find the corresponding route for the request.
     *
     * $route[0]: Request method of the route
     * $route[1]: Uri of the route
     * $route[2]: Class and method for the route
     * @return array|null
     */
    public function findMatch()
    {
        foreach ($this->routeCollection as $route) {
            if($this->requestUri === $route[1]){
                if($this->requestMethod !== $route[0])
                {
                    $this->status = self::METHOD_NOT_ALLOWED;
                    return null;
                }

                $this->status = self::FOUND;
                return $route;
            }
        }

        $this->status = self::NOT_FOUND;
        return null;
    }
}