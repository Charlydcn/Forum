<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager
{

    protected $className = "Model\Entities\User";
    protected $tableName = "user";


    public function __construct()
    {
        parent::connect();
    }

    public function editUser($id, $email, $role)
    {
        $sql = "UPDATE user
                SET email = :email, role = :role
                WHERE id_user = :id";

        DAO::update(
            $sql,
            [
                "id" => $id,
                "email" => $email,
                "role" => $role
            ]
        );
    }

    public function editUsername($username, $id)
    {
        $sql = "UPDATE user
        SET username = :username
        WHERE id_user = :id";

        DAO::update($sql, ["username" => $username, "id" => $id]);
    }

    public function editUserPassword($id, $password)
    {
        $sql = "UPDATE user
            SET password = :password
            WHERE id_user = :id";

        DAO::update(
            $sql,
            [
                "id" => $id,
                "password" => $password
            ]
        );
    }
}
