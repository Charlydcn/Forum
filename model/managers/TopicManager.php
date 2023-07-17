<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }

        public function listTopicsByCategory($id, $order = null)
        {
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";
                
            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE category_id = $id"
                    .$orderQuery;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );

        }

    }