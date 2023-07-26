<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager
{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct()
    {
        parent::connect();
    }

    public function editPost($id, $content)
    {
        $sql = "UPDATE post
                SET content = :content, modificationDate = CURRENT_TIMESTAMP
                WHERE id_post = :id";

        DAO::update(
            $sql,
            [
                "content" => $content,
                "id" => $id
            ]
        );        
    }

}
