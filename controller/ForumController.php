<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategoryManager;
    
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

        public function listTopicsByCategory($id) {

            $topicManager = new TopicManager();
            $topics = $topicManager->listTopicsByCategory($id);

            return [
                "view" => VIEW_DIR."forum/topicsList.php",
                "data" => [
                    "topics" => $topics
                ]
            ];
        
        }

        // public function listTopics($id) {

        //     $postManager = new PostManager();
        //     $posts = $postManager->listPostsByTopics($id);

        //     return [
        //         "view" => VIEW_DIR. "forum/postsList.php",
        //         "data" => [
        //             "posts" => $posts
        //         ]
        //         ];
        // }

    }
