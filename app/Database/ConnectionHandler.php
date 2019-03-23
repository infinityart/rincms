<?php
/**
 * Class ConnectionHandler.php
 *
 * Handles the possible connection types.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 22/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Database;


class ConnectionHandler
{
    /**
     * Make a PDO connection with the driver in the config.
     *
     * @param array $config
     * @return \PDO
     * @throws \Exception
     */
    public function resolve(array $config): \PDO
    {
        $className = $this->resolveClass($config['driver']);

        $connection = new $className;

        $this->hasImplementation($connection);

        return $connection->connect($config['host'], $config['username'], $config['password'], $config['database']);
    }

    /**
     * Resolve the class name of the asked driver Connection class.
     *
     * @param string $driver
     * @return string
     * @throws \Exception
     */
    private function resolveClass(string $driver): string
    {
        $className = __NAMESPACE__ . '\\' . $driver . "Connection";

        if(!class_exists($className)){
            throw new \Exception("Connection class doesn't exist for the driver {$driver}.");
        }

        return $className;
    }

    /**
     * Checks if the Driver Connection class implements the correct interface.
     *
     * @param object $connection
     * @throws \Exception
     */
    private function hasImplementation(object $connection): void
    {
        if(!$connection instanceof ConnectionInterface){
            throw new \Exception('Connection class needs to implement ConnectionInterface.');
        }
    }
}