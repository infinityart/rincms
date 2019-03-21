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


class LoginController extends AdminController implements ControllerInterface
{
    public function show()
    {
        $html = $this->templates->render('admin::login', ['title' => 'Login']);

        $this->response->setContent($html);
    }
}