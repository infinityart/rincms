<?php
/**
 * Class HomeController.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 18/03/2019
 * @version 0.1 18/03/2019 Initial class definition.
 */
declare(strict_types=1);

namespace RinCMS\Site\Controllers;

class HomeController implements ControllerInterface
{
    public function show()
    {
        return 'hello world';
    }
}