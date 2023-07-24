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

    // public function listPostsByTopic($id)
    // {
    //     $sql = "SELECT *
    //             FROM post
    //             WHERE topic_id = :id";

    //     return $this->getMultipleResults(
    //         DAO::select($sql, ["id" => $id]),
    //         $this->className
    //     );
    // }

    // public function listPostsByTopic($id)
    // {

    //     $postManager = new PostManager();
    //     $posts = $postManager->findMultipleBy('topic_id', $id);

    //     return [
    //         "view" => VIEW_DIR . "forum/postsByTopic.php",
    //         "data" => [
    //             "posts" => $posts
    //         ]
    //     ];
    // }

}
