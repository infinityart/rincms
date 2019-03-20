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

class DashboardController implements ControllerInterface
{
    public function show()
    {
        return 'admin dashboard';
    }
}