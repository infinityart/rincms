<?php
/**
 * Class AdminController.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 20/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Admin\Controllers;

use League\Plates\Engine;
use RinCMS\Http\Request;
use RinCMS\Http\Response;

class AdminController
{
    /** @var Request  */
    protected $request;

    /** @var Response  */
    protected $response;

    /** @var Engine  */
    protected $templates;

    /**
     * AdminController constructor.
     * @param Request $request
     * @param Response $response
     * @param Engine $templates
     */
    public function __construct(Request $request, Response $response, Engine $templates)
    {
        $this->request = $request;
        $this->response = $response;
        $this->templates = $templates;
    }

    protected function model($model)
    {
    }

    protected function view(string $file, array $data)
    {
        return $this->templates->render($file, $data);
    }
}