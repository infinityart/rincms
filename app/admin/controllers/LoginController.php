<?php
/**
 * Class LoginController.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 20/03/2019
 */
declare(strict_types=1);

namespace RinCMS\admin\controllers;


use RinCMS\Admin\Authenticator\Authenticator;
use RinCMS\Admin\Models\Dao\DbUser;
use RinCMS\Admin\Models\User;
use RinCMS\Session\Session;

class LoginController extends AdminController implements ControllerInterface
{
    public function show()
    {
        $session = new Session();
        $authenticator = new Authenticator($session);

        if($authenticator->authenticate())
        {
            $this->response->redirect('/admin');
        }

        $html = $this->view('admin::template', ['title' => 'Login', 'layout' => 'login']);

        $this->response->setContent($html);
    }

    public function login()
    {
        $dao = new DbUser();
        $user = new User();
        $session = new Session();

        $formEmail = $this->request->getPostParameter('email', FILTER_VALIDATE_EMAIL);
        $formPassword = $this->request->getPostParameter('password', FILTER_SANITIZE_STRING);

        if(empty($userResult = $dao->showByEmail((string) $formEmail))){
            // Error email or pass are wrong
            return;
        }

        $user->setId((int)$userResult['id']);
        $user->setName($userResult['name']);
        $user->setEmail($userResult['email']);
        $user->setPassword($userResult['password']);

        if(!$user->passwordVerify((string) $formPassword)){
            // Error email or pass are wrong
            return;
        }

        $session->addToSession('user', $user);
        $session->addToSession('lastActivity', time());

        $session->regenerateID();

        $this->response->redirect('/admin');
    }
}