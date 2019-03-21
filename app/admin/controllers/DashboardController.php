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

use RinCMS\admin\models\user;

class DashboardController extends AdminController implements ControllerInterface
{
    public function show()
    {
        $user = new user();

        $user->name = 'jonty';
        $user->color = 'purple';

        $html = $this->view('admin::template', ['title' => 'Dashboard']);

        $this->response->setContent($html);
    }
}