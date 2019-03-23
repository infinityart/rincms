<?php
/**
 * Class Dao.php
 *
 * The database access object for connecting with the database.
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 22/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Admin\Models\Dao;


use RinCMS\Database\Database;

class Dao
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * dao constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->db = new Database([
            'driver' => 'Mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'rincms'
        ]);
    }
}