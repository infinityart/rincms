<?php
/**
 * Class Response.php
 *
 * Data holder for the HTTP response.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 19/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Http;

class Response
{
    /** @var string */
    private $httpVersion;

    /** @var int */
    private $statusCode;

    /** @var string */
    private $statusText;

    /** @var array */
    private $headers;

    /** @var string */
    private $content;

    /** @var array */
    private $statusTexts;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->httpVersion = '1.1';
        $this->statusCode = 200;
        $this->statusText = 'OK';
        $this->headers = [];
        $this->content = '';
        $this->statusTexts = include 'statusTexts.php';
    }

    /**
     * Sets the HTTP status code
     *
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        if (!array_key_exists($statusCode, $this->statusTexts)) {
            throw new \InvalidArgumentException('Status code doens\' exists.');
        }

        $this->statusCode = $statusCode;
        $this->statusText = $this->statusTexts[$statusCode];
    }

    /**
     * Returns the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Sets a new header with the given name.
     *
     * @param string $name
     * @param string $value
     */
    public function setHeader(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    /**
     * Returns an array with the HTTP headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        $headers = array_merge(
            $this->getRequestLineHeaders(),
            $this->getStandardHeaders()
        );

        return $headers;
    }

    /**
     * Sets the body content.
     *
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Returns the body content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Sets the header for a redirect.
     *
     * @param  string $url
     */
    public function redirect($url): void
    {
        $this->setHeader('Location', $url);
        $this->setStatusCode(301);
    }

    /**
     * Send every stored header to the browser.
     */
    public function sendHeaders(): void
    {
        foreach ($this->getHeaders() as $header){
            header($header);
        }
    }

    /**
     * Returns the request line header.
     *
     * @return array
     */
    private function getRequestLineHeaders(): array
    {
        $requestLine = "HTTP/{$this->httpVersion} {$this->statusCode} {$this->statusText}";

        return [$requestLine];
    }

    /**
     * Returns every added header in an array.
     *
     * @return array
     */
    private function getStandardHeaders(): array
    {
        $headers = [];

        foreach ($this->headers as $name => $value) {
            $headers[] = "$name: $value";
        }

        return $headers;
    }
}