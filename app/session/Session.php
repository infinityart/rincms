<?php
/**
 * Class Session.php
 *
 * Session main class.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 23/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Session;


class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->sessionStart();
    }

    /**
     * Add a value to the key in the session.
     *
     * @param string $key
     * @param $value
     */
    public function addToSession(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Delete session variable by the key.
     *
     * @param string $key
     */
    public function deleteFromSession(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Returns session variable by the key.
     *
     * @param string $key
     * @return bool|mixed
     */
    public function getFromSession(string $key)
    {
        if(!array_key_exists($key, $_SESSION)){
            return false;
        }

        return $_SESSION[$key];
    }

    /**
     * Start the session.
     */
    public function sessionStart(): void
    {
        session_start([
            'use_strict_mode' => true
        ]);
    }

    /**
     * End the current session.
     */
    public function sessionEnd(): void
    {
        session_unset();
    }

    /**
     * Regenerate the session ID.
     */
    public function regenerateID(): void
    {
        session_regenerate_id();
    }
}