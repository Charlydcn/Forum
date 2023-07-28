<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use Model\Managers\UserManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {

        $categoryManager = new CategoryManager();
        $category = $categoryManager->findAll(["name", "ASC"]);

        return [
            "view" => VIEW_DIR . "forum/categoriesList.php",
            "data" => [
                "category" => $category
            ]
        ];
    }

    public function listCategories()
    {

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(["name", "ASC"]);

        return [
            "view" => VIEW_DIR . "forum/categoriesList.php",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopics($id)
    {

        $topicManager = new TopicManager();
        $topics = $topicManager->listTopics();

        return [
            "view" => VIEW_DIR . "forum/topicsList.php",
            "data" => [
                "topics" => $topics
            ]
        ];
    }
    
    public function listTopicsByCategory($id)
    {

        $topicManager = new TopicManager();
        $topics = $topicManager->listTopicsByCategory($id);

        return [
            "view" => VIEW_DIR . "forum/topicsList.php",
            "data" => [
                "topics" => $topics
                ]
            ];
        }

    public function listUsers()
    {

        $userManager = new UserManager();
        $users = $userManager->findAll(["username", "ASC"]);

        return [
            "view" => VIEW_DIR . "forum/usersList.php",
            "data" => [
                "users" => $users
            ]
        ];
    }
        
        public function listPostsByTopic($id)
    {

        $postManager = new PostManager();
        $posts = $postManager->findAllByForeignId('topic', $id);

        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "forum/postsByTopic.php",
            "data" => [
                "posts" => $posts,
                "topic" => $topic
            ]
        ];
    }

    public function listPostsByUser($id)
    {
        $postManager = new PostManager();
        $posts = $postManager->findAllByForeignId('user', $id);

        $userManager = new UserManager();
        $user = $userManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "user/postsByUser.php",
            "data" => [
                "posts" => $posts,
                "user" => $user
            ]
        ];
    }

    public function userDetails($id)
    {

        $userManager = new UserManager();
        $user = $userManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "user/userDetails.php",
            "data" => [
                "user" => $user
            ]
        ];
    }
}
