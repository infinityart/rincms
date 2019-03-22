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


use RinCMS\Database\Database;

class LoginController extends AdminController implements ControllerInterface
{
    public function show()
    {
        $html = $this->templates->render('admin::template', ['title' => 'Login', 'layout' => 'login']);

        $this->response->setContent($html);
    }

    public function login()
    {
        $config =[
            "driver" => 'Mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'rincms'
        ];

        $db = new Database($config);

        $select = "SELECT * FROM users";

        $result = $db->query($select);

        var_dump($result);
        echo 'loggin in';
    }
}