<?php
/**
 * Class MysqlConnection.php
 *
 * Connection class for making connection with the database using the PDO interface with the MySQL driver.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 22/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Database;


class MysqlConnection implements ConnectionInterface
{
    /**
     * Connect to the database by using the PDO interface with the MySQL driver.
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $database
     * @return \PDO
     */
    public function connect(string $host, string $username, string $password, string $database) : \PDO
    {
        return new \PDO("mysql:host={$host};dbname={$database}", $username, $password);
    }
}