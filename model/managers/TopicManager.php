<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct()
    {
        parent::connect();
    }

    public function listTopicsByCategory($id, $order = null)
    {
        $sql = "SELECT t.*, subquery.lastActivity, subquery.nbPosts
                FROM topic t
                INNER JOIN (
                    SELECT topic_id, MAX(creationDate) AS lastActivity, COUNT(id_post) AS nbPosts
                    FROM post
                    GROUP BY topic_id
                ) subquery ON t.id_topic = subquery.topic_id
                WHERE t.category_id = :id
                ORDER BY lastActivity DESC";

        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $id]),
            $this->className
        );
    }

    public function listTopics()
    {
        $sql = "SELECT t.*, subquery.lastActivity, subquery.nbPosts
                FROM topic t
                INNER JOIN (
                    SELECT topic_id, MAX(creationDate) AS lastActivity, COUNT(id_post) AS nbPosts
                    FROM post
                    GROUP BY topic_id
                ) subquery ON t.id_topic = subquery.topic_id
                ORDER BY lastActivity DESC";

        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }



}
