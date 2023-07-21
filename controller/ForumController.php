<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          
           $categoryManager = new CategoryManager();
           $category = $categoryManager->findAll(["name", "ASC"]);
           
            return [
                "view" => VIEW_DIR."forum/categoriesList.php",
                "data" => [
                    "category" => $category
                ]
            ];
        }

        public function listCategories(){
          
            $categoryManager = new CategoryManager();
            $category = $categoryManager->findAll(["name", "ASC"]);
            
             return [
                 "view" => VIEW_DIR."forum/categoriesList.php",
                 "data" => [
                     "category" => $category
                 ]
             ];
         
         }

        public function listTopics($id) {

            $topicManager = new TopicManager();
            $topics = $topicManager->findAll(["creationDate", "DESC"]);

            return [
                "view" => VIEW_DIR. "forum/topicsList.php",
                "data" => [
                    "topics" => $topics
                ]
                ];
        }

        public function listUsers() {
            
            $userManager = new UserManager();
            $users = $userManager->findAll(["username", "ASC"]);

            return [
                "view" => VIEW_DIR. "forum/usersList.php",
                "data" => [
                    "users" => $users
                ]
                ];
        }

        public function listTopicsByCategory($id) {

            $topicManager = new TopicManager();
            $topics = $topicManager->listTopicsByCategory($id);

            // $count = $this->countTopic($id);
            
            return [
                "view" => VIEW_DIR."forum/topicsList.php",
                "data" => [
                    "topics" => $topics
                ]
                ];
        
        }

        public function userDetails($id) {

            $userManager = new UserManager();
            $user = $userManager->findOneById($id);

            return [
                "view" => VIEW_DIR."user/userDetails.php",
                "data" => [
                    "user" => $user
                ]
            ];
        }

        // public function countTopics($id)
        // {

        //     $categoryManager = new CategoryManager();
        //     $nbOfTopics = $categoryManager->countTopics($id);

        //     return $nbOfTopics;

        // }


        

    }
