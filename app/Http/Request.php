<?php
/**
 * Class Request.php
 *
 * Layer above the PHP Superglobals for requesting data
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 19/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Http;

class Request
{
    /** @var array */
    private $getParameters;

    /** @var array */
    private $postParameters;

    /** @var array */
    private $server;

    /** @var string */
    private $inputStream;

    /** @var array */
    private $supportedFilters;

    /**
     * Request constructor.
     * @param array $get
     * @param array $post
     * @param array $server
     * @param string $inputStream
     */
    public function __construct(array $get, array $post, array $server, $inputStream = '')
    {
        $this->getParameters = $get;
        $this->postParameters = $post;
        $this->server = $server;
        $this->inputStream = $inputStream;
        $this->supportedFilters = include 'supportedFilters.php';
    }

    /**
     * Get the query parameter by the key and filter it with the given filter.
     *
     * @param string $key
     * @param int $filter
     * @return mixed|null
     */
    public function getQueryParameter(string $key, $filter = FILTER_DEFAULT)
    {
        $this->filterAllowed($filter);

        if(!array_key_exists($key, $this->getParameters))
        {
            return null;
        }

        return filter_var($this->getParameters[$key], $filter);
    }

    /**
     * Get the post parameter by the key and filter it with the given filter.
     *
     * @param string $key
     * @param int $filter
     * @return mixed|null
     */
    public function getPostParameter(string $key, $filter = FILTER_DEFAULT)
    {
        $this->filterAllowed($filter);

        if(!array_key_exists($key, $this->postParameters))
        {
            return null;
        }

        return filter_var($this->postParameters[$key], $filter);
    }

    /**
     * Get the request method which was used to access the page.
     *
     * @param int $filter
     * @return string
     */
    public function getMethod($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('REQUEST_METHOD', $filter);
    }

    /**
     * Get the path and query string of the page.
     *
     * @param int $filter
     * @return string
     */
    public function getURI($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('REQUEST_URI', $filter);
    }

    /**
     * Get the query string of the page.
     *
     * @param int $filter
     * @return string
     */
    public function getQueryString($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('QUERY_STRING', $filter);
    }

    /**
     * Get the path of the page.
     *
     * @param int $filter
     * @return string
     */
    public function getPath($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('PATH_INFO', $filter);
    }

    /**
     * Get the IP address of the client who accessed the page.
     *
     * @param int $filter
     * @return string
     */
    public function getClientIp($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('REMOTE_ADDR', $filter);
    }

    /**
     * Get the accepted headers of the page.
     *
     * @param int $filter
     * @return string
     */
    public function getHttpAcceptHeaders($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('HTTP_ACCEPT', $filter);
    }

    /**
     * Get the user agent of the client who accessed the page.
     *
     * @param int $filter
     * @return string
     */
    public function getClientUserAgent($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('HTTP_USER_AGENT', $filter);
    }

    /**
     * Get the URL which the user was referred from.
     *
     * @param int $filter
     * @return string
     */
    public function getReferer($filter = FILTER_DEFAULT): string
    {
        return $this->getServerVariable('HTTP_REFERER', $filter);
    }

    /**
     * Get the raw body from the request.
     *
     * @return string
     */
    public function getRawBody(): string
    {
        return $this->inputStream;
    }

    /**
     * Get the server variable by the key and filter it with the given filter.
     *
     * @param $key
     * @param int $filter
     * @return string
     */
    private function getServerVariable($key, int $filter): string
    {
        $this->filterAllowed($filter);

        if(!array_key_exists($key, $this->server))
        {
            throw new \InvalidArgumentException('Server variable doesn\'t exists');
        }

        return filter_var($this->server[$key], $filter);
    }

    /**
     * Check whether the given filter is allowed or not.
     *
     * @param int $filter
     * @return bool
     */
    private function filterAllowed(int $filter): bool
    {
        if(!in_array($filter, $this->supportedFilters)){
            throw new \InvalidArgumentException('Filter is not valid, look in the supportedFilters.php for valid filters.');
        }

        return true;
    }
}