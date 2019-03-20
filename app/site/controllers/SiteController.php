<?php
/**
 * Class SiteController.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 20/03/2019
 */
declare(strict_types=1);

namespace RinCMS\site\controllers;


use RinCMS\Http\Request;
use RinCMS\Http\Response;

class SiteController
{
    /** @var Request  */
    protected $request;

    /** @var Response  */
    protected $response;

    /**
     * SiteController constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}