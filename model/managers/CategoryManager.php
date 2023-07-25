<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager
{

    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct()
    {
        parent::connect();
    }

    public function editCategory($id, $categoryName)
    {
        $sql = "UPDATE category
                SET name = :categoryName
                WHERE id_category = :id";

        DAO::update(
            $sql,
            [
                "categoryName" => $categoryName,
                "id" => $id
            ]
        );        
    }

    public function createCategory($categoryName)
    {
        $sql = "INSERT INTO category (name)
                VALUES ('$categoryName')";

        DAO::insert($sql);
    }
}
