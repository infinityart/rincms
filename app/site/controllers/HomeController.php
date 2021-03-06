<?php
/**
 * Class HomeController.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 18/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Site\Controllers;

class HomeController extends SiteController implements ControllerInterface
{
    public function show()
    {
        $this->response->setContent('hello world');
    }
}