<?php
/**
 * Class Database.php
 *
 * Database class for executing queries.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 22/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Database;


class Database
{
    const INSERT = 'INSERT';
    const SELECT = 'SELECT';
    const UPDATE = 'UPDATE';
    const DELETE = 'DELETE';

    /** @var array  */
    private $config;

    /** @var bool */
    private $debug;

    /** @var \PDO */
    private $connection;

    /**
     * Database constructor.
     * @param array $config
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->debug = false;

        $this->connect(new ConnectionHandler());
    }

    /**
     * Execute the given query using the params.
     *
     * @param string $query
     * @param array $params
     * @param int $fetchStyle
     * @return array|bool|int|mixed|string
     * @throws \Exception
     */
    public function query(string $query, $params = [], $fetchStyle = \PDO::FETCH_ASSOC)
    {
        $queryType = $this->determineQueryType($query);

        if(!$stmt = $this->execute($query, $params)){
            return false;
        }

        return $this->handleByQueryType($stmt, $queryType, $fetchStyle);
    }

    /**
     * Return the used query type.
     * E.g.: INSERT, SELECT, UPDATE, DELETE
     *
     * @param string $query
     * @return string
     */
    private function determineQueryType(string $query): string
    {
        return strtok(trim($query), ' ');
    }

    /**
     * Prepare and execute the query using the params.
     * Returns the PDOStatement.
     *
     * @param string $query
     * @param array $params
     * @return bool|\PDOStatement
     */
    private function execute(string $query, array $params)
    {
        $stmt = $this->connection->prepare($query);

        if(!$stmt->execute($params)){
            if($this->debug){
                $this->showDebugInfo($stmt);
            }

            return false;
        }

        return $stmt;
    }

    /**
     * Shows the debug dump and error info.
     *
     * @param \PDOStatement $stmt
     */
    private function showDebugInfo(\PDOStatement $stmt): void
    {
        $stmt->debugDumpParams();
        echo "<br>{$this->config['driver']} Driver error:<br>";
        echo "SQLSTATE: {$stmt->errorInfo()[0]}<br>";
        echo "Error code: {$stmt->errorInfo()[1]}<br>";
        echo "Error message: {$stmt->errorInfo()[2]}<br>";
    }

    /**
     * Return the result determined by the query type.
     *
     * @param \PDOStatement $stmt
     * @param string $queryType
     * @param int $fetchStyle
     * @return array|int|mixed|string
     * @throws \Exception
     */
    private function handleByQueryType(\PDOStatement $stmt, string $queryType, int $fetchStyle)
    {
        switch ($queryType){
            case self::INSERT:
                return $this->connection->lastInsertId();
            case self::SELECT:
                if($stmt->rowCount() === 1){
                    return $stmt->fetch($fetchStyle);
                }

                return $stmt->fetchAll($fetchStyle);
            case self::UPDATE:
                return $stmt->rowCount();
            case self::DELETE:
                return $stmt->rowCount();
            default:
                throw new \Exception("Query type {$queryType} not supported.");
        }
    }

    /**
     * Make a connection to the database, using PDO
     * as the interface and the driver in the config.
     *
     * @param ConnectionHandler $connection
     * @throws \Exception
     */
    private function connect(ConnectionHandler $connection): void
    {
        $this->connection = $connection->resolve($this->config);
    }
}