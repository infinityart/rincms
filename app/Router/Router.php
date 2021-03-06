<?php
/**
 * Class router.php
 *
 * Resolve the route of the collection
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 17/03/2019
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
    private $routeParser;

    /** @var int */
    public $status;

    /**
     * Router constructor.
     * @param RouteParser $routeParser
     */
    public function __construct(RouteParser $routeParser)
    {
        $this->requestUri = $this->parseRequestUri($_SERVER['REQUEST_URI']);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->routeParser = $routeParser;
    }

    /**
     * Add the route collection.
     *
     * @param array $routeCollection
     */
    public function addCollection(array $routeCollection): void
    {
        $this->routeCollection = $routeCollection;
    }

    /**
     * Give route data back to the corresponding request.
     *
     * @return null|Route
     * @throws \Exception
     */
    public function route(): ?Route
    {
        if(!$route = $this->findMatch()) {
            return null;
        }

        return $this->routeParser->parseToObject($route);
    }

    /**
     * Find the corresponding route for the request.
     *
     * $route[0]: Request method of the route
     * $route[1]: Uri of the route
     * $route[2]: Class and method for the route
     *
     * @return array|null
     */
    public function findMatch(): ?array
    {
        $possibleRoutes = [];

        foreach ($this->routeCollection as $route) {
            if($this->requestUri === $route[1]){
                $possibleRoutes[] = $route;
            }
        }

        foreach ($possibleRoutes as $idx => $possibleRoute){
            if($this->requestMethod === $possibleRoute[0])
            {
                $this->status = self::FOUND;
                return $possibleRoute;
            }

            if(end($possibleRoutes) === $idx){
                $this->status = self::METHOD_NOT_ALLOWED;
                return null;
            }
        }

        $this->status = self::NOT_FOUND;
        return null;
    }

    /**
     * Remove the last / in the request URI.
     *
     * @param string $requestUri
     * @return string
     */
    private function parseRequestUri(string $requestUri): string
    {
        $requestUri = rtrim($requestUri, '/');

        return $requestUri;
    }
}