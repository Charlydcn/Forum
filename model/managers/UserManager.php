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

    public function editEmail($id, $email)
    {
        $sql = "UPDATE user
                SET email = :email
                WHERE id_user = :id";

        DAO::update(
            $sql,
            [
                "id" => $id,
                "email" => $email
            ]
        );
    }

    public function editRole($id, $role)
    {
        $sql = "UPDATE user
                SET role = :role
                WHERE id_user = :id";

        DAO::update(
            $sql,
            [
                "id" => $id,
                "role" => $role
            ]
        );
    }

    public function editUsername($username, $id)
    {
        $sql = "UPDATE user
        SET username = :username
        WHERE id_user = :id";

        DAO::update(
            $sql,
            [
                "username" => $username,
                "id" => $id
            ]
        );
    }

    public function editPassword($id, $password)
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

    public function editBan($id, $ban)
    {
        $sql = "UPDATE user
                SET ban = :ban
                WHERE id_user = :id";

        DAO::update(
            $sql,
            [
                "id" => $id,
                "ban" => $ban
            ]
        );
    }
}
