<?php
/**
 * Interface for the different types of driver connections.
 *
 * @author: Jonty Sponselee <jsponselee97@gmail.com>
 * @since: 3/22/2019
 */

namespace RinCMS\Database;


interface ConnectionInterface
{
    public function connect(string $host, string $username, string $password, string $database) : \PDO;
}