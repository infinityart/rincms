<?php
/**
 * Class Authenticator.php
 *
 * Authenticate if the user is logged in.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 23/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Admin\Authenticator;


use RinCMS\Session\Session;

class Authenticator
{
    /** @var Session  */
    private $session;

    /**
     * Authenticator constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Authenticate the user.
     *
     * @return bool
     */
    public function authenticate()
    {
        if(!$user = $this->session->getFromSession('user')){
            return false;
        }

        return true;
    }
}