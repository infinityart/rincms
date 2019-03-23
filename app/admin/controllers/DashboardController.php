<?php
/**
 * Class DashboardController.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 18/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Admin\Controllers;

use RinCMS\Admin\Authenticator\Authenticator;
use RinCMS\Session\Session;

class DashboardController extends AdminController implements ControllerInterface
{
    public function show()
    {
        $authenticator = new Authenticator(new Session());

        if(!$authenticator->authenticate())
        {
            $this->response->redirect('/admin/login');
        }

        $html = $this->view('admin::template', ['title' => 'Dashboard', 'layout' => 'dashboard']);

        $this->response->setContent($html);

        var_dump($_SESSION);
    }

    public function logout()
    {
        $session = new Session();

        $session->sessionEnd();

        $this->response->redirect('/admin/login');
    }
}