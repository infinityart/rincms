<?php
/**
 * Class DbUser.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 22/03/2019
 */
declare(strict_types=1);

namespace RinCMS\Admin\Models\Dao;


class DbUser extends dao
{
    public function index()
    {

    }

    public function showByEmail(string $email)
    {
        $query = "
        SELECT * FROM users
        WHERE email = :email
        ";

        if(($result = $this->db->query($query, [':email' => $email])) === false){
            // oops
        }

        return $result;
    }
}