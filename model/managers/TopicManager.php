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
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT *
                    FROM " . $this->tableName . " a
                    WHERE a.category_id = :id"
            . $orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $id]),
            $this->className
        );
    }

    // public function countTopics($id)
    // {

    //     $sql = "SELECT COUNT(*) as topic_count
    //             FROM category
    //             INNER JOIN topic ON category.id_category = topic.category_id
    //             WHERE category.id_category = :id
    //             GROUP BY category.id_category";

    //     $count = $this->getOneOrNullResult(
    //         DAO::select($sql, ["id" => $id]),
    //         'category'
    //     );
    //     return $count;

    // }

}
