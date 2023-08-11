<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface
{

    public function index()
    {
    }

    public function displayRegister()
    {
        return [
            "view" => VIEW_DIR . "security/register.php",
        ];
    }

    public function displayLogin()
    {
        return [
            "view" => VIEW_DIR . "security/login.php",
        ];
    }

    public function register()
    {
        if (isset($_POST['submit'])) {

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if ($username && $email && $pass1 && $pass2) {

                // si les mots de passe correspondent et que la longueur de ces derniers n'excède pas 25 caractères et soit de minimum 8 caractères
                if ($pass1 === $pass2 && strlen($pass1) <= 25 && strlen($pass1) >= 8) {
                    $password = password_hash($pass1, PASSWORD_DEFAULT);

                    // vérification de l'existance de l'utilisateur en bdd par l'e-mail
                    $userManager = new UserManager();
                    $user = $userManager->findOneBy('email', $email);
                    // vérification de la disponibilité du pseudo
                    $userUsername = $userManager->findOneBy('username', $username);

                    if ($user) {
                        // utilisateur existe déjà en bdd
                        Session::addFlash("error", "An account with this email already exists");
                        $this->redirectTo("security", "displayRegister");
                    } else {
                        // utilisateur n'existe pas en bdd  
                        // on vérifie que le username ne soit pas déjà utilisé
                        if ($userUsername) {
                            Session::addFlash("error", "Username already taken");
                            $this->redirectTo("security", "displayRegister");
                        } else {
                            // ajout en bdd                               
                            $userManager->add(['username' => $username, 'password' => $password, 'email' => $email]);

                            Session::addFlash("success", "Account successfully created !");
                            $this->redirectTo("home");
                        }
                    }
                } else {
                    // les passwords ne matchent pas
                    Session::addFlash("error", "Passwords don't match !");
                    $this->redirectTo("security", "displayRegister");
                }
            } else {
                // valeurs incorrectes
                Session::addFlash("error", "Incorrect values");
                $this->redirectTo("security", "displayRegister");
            }
        }
    }

    public function logIn()
    {
        if ($_POST['submit']) {

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($email && $password) {
                // vérification que l'utilisateur existe
                $userManager = new UserManager();
                $user = $userManager->findOneBy('email', $email);

                if ($user) {
                    $hash = $user->getPassword();

                    if (password_verify($password, $hash)) {
                        Session::setUser($user);
                        Session::addFlash("success", "You have been successfully logged in");
                        $this->redirectTo("home");
                    } else {
                        // valeurs incorrectes
                        Session::addFlash("error", "Incorrect password");
                        $this->redirectTo("security", "displayLogin");
                    }
                } else {
                    // utilisateur inconnu de la bdd
                    Session::addFlash("error", "Account doesn't exist");
                    $this->redirectTo("security", "displayLogin");
                }
            } else {
                // valeurs incorrectes
                Session::addFlash("error", "Incorrect values");
                $this->redirectTo("security", "displayLogin");
            }
        }
    }

    public function logOff($id)
    {
        unset($_SESSION['user']);
        Session::addFlash("success", "You have been successfully logged off");
        $this->redirectTo("home");
    }

    public function editUser($id)
    {
        if (isset($_POST['submit'])) {

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ban = filter_input(INPUT_POST, 'ban');
            
            $userManager = new UserManager();
            $user = $userManager->findOneById($id);
            
            $ban === null ? $ban = 0 : $ban = 1; 


            // PASSWORD
            // on vérifie que le mdp a été changé
            if (is_string($pass1) && !empty($pass1)) {
                // on vérifie que le mot de passe est correct et que les deux correspondent
                if($pass1 && $pass1 === $pass2) {
                    // on récupère le hash du password actuel de l'utilisateur
                    $hash = $user->getPassword();
                    // on compare le hash du password actuel avec le password donné dans le formulaire, donc si l'utilisateur donne le même
                    // mot de passe qui est déjà en bdd, on le redirige, erreur etc.
                    if(password_verify($pass1, $hash)) {
                        Session::addFlash("error", "New password is the same as the old one");
                        $this->redirectTo("forum", "userDetails", $id);
                        die;
                    } else {
                        // on vérifie qu'il n'y ait pas d'espace vide dans le mot de passe, et qu'il soit entre 8 et 25 caractères
                        if (strpos($pass1, ' ') === false && strlen($pass1) <= 25 && strlen($pass1) >= 8) {
                            // !! TOUTE LES CONDITIONS SONT REMPLIES !!
                            $password = password_hash($pass1, PASSWORD_DEFAULT);
                            
                            // SUCCESS !!
                            $userManager->editPassword($id, $password);

                        } else {
                            // si il y a des espaces vides, on redirige, erreur etc.
                            Session::addFlash("error", "Passwords can't have empty spaces and have to be 8-25 characters");
                            $this->redirectTo("forum", "userDetails", $id);
                            die;
                        }
                    }
                } else {
                    Session::addFlash("error", "Incorrect password or passwords don't match");
                    $this->redirectTo("forum", "userDetails", $id);
                    die;
                }
            }

            // USERNAME            
            $userUsername = $userManager->findOneBy('username', $username);
            // on vérifie que l'username passe le filter_input et ne contient pas d'espace
            if ($user->getUsername() != $username) {
                if ($username && strpos($username, ' ') === false) {
                    // on vérifie qu'il n'est pas déjà utilisé en bdd
                    if (!$userUsername) {
                             
                        // SUCCESS !!
                        $userManager->editUsername($username, $id);

                    } else {
                        Session::addFlash("error", "Username unavailable");
                        $this->redirectTo("forum", "userDetails", $id);
                        die;    
                    }
                } else {
                    Session::addFlash("error", "Incorrect username");
                    $this->redirectTo("forum", "userDetails", $id);
                    die;
                }
            }

            // EMAIL
            $userEmail = $userManager->findOneBy('email', $email); 

            // on vérifie si l'utilisateur a modifié l'email
            if ($email != $user->getEmail()) {
                // filter_input
                if ($email) {
                    // et que l'email n'est pas déjà utilisé
                    if (!$userEmail) {
                            
                        // SUCCESS !!
                        $userManager->editEmail($id, $email);
                       
                    } else {
                        Session::addFlash("error", "Email already used");
                        $this->redirectTo("forum", "userDetails", $id);
                        die;
                    }
                } else {
                    Session::addFlash("error", "Incorrect email or email already used");
                    $this->redirectTo("forum", "userDetails", $id);
                    die;
                }
            }

            // ROLE
            if (Session::getUser()->getRole() == 'admin') {
                if ($role != $user->getRole()) {
                    if ($role) {
                               
                        // SUCCESS !!
                        $userManager->editRole($id, $role);
                    } else {
                        Session::addFlash("error", "Incorrect role");
                        $this->redirectTo("forum", "userDetails", $id);
                        die;
                    }
                }
            }

            // BAN 
            if (Session::getUser()->getRole() == 'admin') {
                if ($ban != $user->getBan()) {
                    if ($ban == 0 || $ban == 1) {
                        
                        // SUCCESS !!
                        $userManager->editBan($id, $ban);
                    } else {
                        Session::addFlash("error", "Incorrect ban data");
                        $this->redirectTo("forum", "userDetails", $id);
                        die;
                    }
                }            
            }

            Session::addFlash("success", "User succesfully modified");
            // si l'utilisateur modifié était celui connecté en session, on l'unset et le set pour actualiser les données 
            $user = $userManager->findOneById($id);
            if ($_SESSION['user']->getId() === $user->getId()) {
                unset($_SESSION['user']);
                Session::setUser($user);
            }


            $this->redirectTo("forum", "userDetails", $id);
        }
    }

    public function deleteUser($id)
    {
        $userManager = new UserManager();
        $userManager->delete($id);
        if (Session::getUser($id)) {
            unset($_SESSION['user']);
        }
        Session::addFlash("success", "User succesfully deleted");
        $this->redirectTo("home");
    }

    public function categoriesDashboard()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(["name", "ASC"]);

        return [
            "view" => VIEW_DIR . "security/categoriesDashboard.php",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function categoryDashboard($id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "security/categoryDashboard.php",
            "data" => [
                "category" => $category
            ]
        ];
        
    }

    public function editCategory($id)
    {
        if(isset($_POST['submit'])) {
            $categoryName = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // on instancie un objet de classe CategoryManager pour utiliser ses méthodes dans les vérifications
            $categoryManager = new CategoryManager();

            // vérification de la catégorie (si il n'est pas vide avec que des espaces)
            // supprime les espaces spéciaux et les espaces vides de la catégorie
            $trimmedCateg = preg_replace('/(&nbsp;|\s)+/', '', $categoryName);
            //  supprime toutes les balises HTML
            $strippedCateg = strip_tags(html_entity_decode($trimmedCateg));
            // si après trim et strip il ne reste plus rien, on ne créer pas la catégorie

            // vérification que le nom de catégorie n'existe pas déjà en bdd
            $categoryExists = $categoryManager->findOneBy("name", $categoryName);
            
            if (empty($strippedCateg)) {
                Session::addFlash("error", "Please enter valid text in your category");
                $this->redirectTo("security", "categoryDashboard", $id);
            } else {
                // si la catégorie de l'utilisateur passe les filtres et qu'elle n'excède pas 20 caractères
                if ($categoryName && strlen($categoryName) <= 20) {
                    // si la catégorie n'existe pas déjà en bdd (le name)
                    if (!$categoryExists) {
                        $categoryManager->editCategory($id, $categoryName);
                        Session::addFlash("success", "Category succesfully modified");
                        $this->redirectTo("security", "categoryDashboard&id=$id");
                    } else {
                        Session::addFlash("error", "Category name already used");
                        $this->redirectTo("security", "categoryDashboard", $id);        
                    }
                } else {
                    Session::addFlash("error", "Incorrect category name");
                    $this->redirectTo("security", "categoryDashboard&id=$id");
                }
            }

        } else {
            $this->redirectTo("home");
        }
    }
    
    public function deleteCategory($id)
    {
        $categoryManager = new CategoryManager();
        $categoryManager->delete($id);

        Session::addFlash("success", "Category succesfully deleted");
        $this->redirectTo("security", "categoriesDashboard");
    }

    public function createCategory()
    {
        if(isset($_POST['submit'])) {

            $categoryName = filter_input(INPUT_POST, 'newCategory', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // on instancie un objet de classe CategoryManager pour utiliser ses méthodes dans les vérifications
            $categoryManager = new CategoryManager();

            // vérification de la catégorie (si il n'est pas vide avec que des espaces)
            // supprime les espaces spéciaux et les espaces vides de la catégorie
            $trimmedCateg = preg_replace('/(&nbsp;|\s)+/', '', $categoryName);
            //  supprime toutes les balises HTML
            $strippedCateg = strip_tags(html_entity_decode($trimmedCateg));

            // vérification que le nom de catégorie n'existe pas déjà en bdd
            $categoryExists = $categoryManager->findOneBy("name", $categoryName);

            // si après trim et strip il ne reste plus rien, on ne créer pas la catégorie
            if (empty($strippedCateg)) {
                Session::addFlash("error", "Please enter valid text in your category");
                $this->redirectTo("security", "categoriesDashboard");
            } else {
                // si la catégorie de l'utilisateur passe les filtres et qu'elle n'excède pas 20 caractères
                if($categoryName && strlen($categoryName) <= 20) {
                    // si la catégorie n'existe pas déjà en bdd (le name)
                    if(!$categoryExists) {
                        $categoryManager->createCategory($categoryName);
                        Session::addFlash("success", "Category succesfully created");
                        $this->redirectTo("security", "categoriesDashboard");
                    } else {
                        Session::addFlash("error", "Category name already used");
                        $this->redirectTo("security", "categoriesDashboard");         
                    }
                } else {
                    Session::addFlash("error", "Incorrect category name");
                    $this->redirectTo("security", "categoriesDashboard");
                }
            }
        } else {
            $this->redirectTo("home");
        }
    }

    public function createPost($id)
    {
        if(isset($_POST['submit'])) {
            $newPost = filter_input(INPUT_POST, 'newPost', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // vérification du message (si il n'est pas vide avec que des espaces)

            // supprime les espaces spéciaux et les espaces vides du message
            $trimmedPost = preg_replace('/(&nbsp;|\s)+/', '', $newPost);

            //  supprime toutes les balises HTML
            $strippedPost = strip_tags(html_entity_decode($trimmedPost));

            // si après trim et strip il ne reste plus rien, on ne créer pas le post
            if (empty($strippedPost)) {
                Session::addFlash("error", "Please enter valid text in your post");
                $this->redirectTo("forum", "listPostsByTopic", $id);
            } else {
                if($newPost) {
                    $postManager = new PostManager();
                    $postManager->add(
                        [
                            'content' => $newPost,
                            'topic_id' => $id,
                            'user_id' => $_SESSION['user']->getId()
                        ]
                        );
                    Session::addFlash("success", "Post successfully sent");
                    $this->redirectTo("forum", "listPostsByTopic", $id);
    
                } else {
                    Session::addFlash("error", "Please enter valid text in your post");
                    $this->redirectTo("forum", "listPostsByTopic", $id);
                }
            }
        } else {
            $this->redirectTo("home");
        }
    }

    public function deletePost($id)
    {
        $postManager = new PostManager();
        $post = $postManager->findOneById($id);
        $topicId = $post->getTopic()->getId();
        $postManager->delete($id);

        Session::addFlash("success", "Post succesfully deleted");
        $this->redirectTo("forum", "listPostsByTopic", $topicId);

    }

    public function editPost($id)
    {
        if(isset($_POST['submit'])) {
            $newPost = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // on instancie un PostManager pour utiliser la fonction qu'on a créé à l'intérieur de ce dernier
            // et pour récupérer le topic_id du post qu'on modifie (pour le redirect)
            $postManager = new PostManager();
            $post = $postManager->findOneById($id);
            $topicId = $post->getTopic()->getId();

            // vérification du message (si il n'est pas vide avec que des espaces)
            // supprime les espaces spéciaux et les espaces vides du message
            $trimmedPost = preg_replace('/(&nbsp;|\s)+/', '', $newPost);
            //  supprime toutes les balises HTML
            $strippedPost = strip_tags(html_entity_decode($trimmedPost));
            // si après trim et strip il ne reste plus rien, on ne crée pas le post
            if (empty($strippedPost)) {
                Session::addFlash("error", "Please enter valid text in your post");
                $this->redirectTo("forum", "listPostsByTopic", $topicId);
            } else {
                // on vérifie que l'utilisateur a bien modifié son post avant de faire la requête pour éviter une requête inutile
                if ($newPost !== $post->getContent()) {
                    if ($newPost) {
                        $postManager->editPost($id, $newPost);
                        Session::addFlash("success", "Post successfully sent");
                        $this->redirectTo("forum", "listPostsByTopic", $topicId);
        
                    } else {
                        Session::addFlash("error", "Please enter valid text in your post");
                        $this->redirectTo("forum", "listPostsByTopic", $topicId);
                    }
                } else {
                    $this->redirectTo("forum", "listPostsByTopic", $topicId);
                }
            }
        } else {
            $this->redirectTo("home");
        }
    }

    public function topicsDashboard()
    {
        $topicManager = new TopicManager();
        $topics =  $topicManager->findAll();

        return [
            "view" => VIEW_DIR . "security/topicsDashboard.php",
            "data" => [
                "topics" => $topics
            ]
        ];
    }

    public function topicDashboard($id)
    {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "security/topicDashboard.php",
            "data" => [
                "topic" => $topic
            ]
        ];
        
    }

    public function editTopic($id)
    {
        if(isset($_POST['submit'])) {

            $topicTitle = filter_input(INPUT_POST, 'topicTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // on instancie un objet de classe TopicManager pour utiliser ses méthodes dans les vérifications
            $topicManager = new TopicManager();

            // vérification du topic (si il n'est pas vide avec que des espaces)
            // supprime les espaces spéciaux et les espaces vides du message
            $trimmedTopicTitle = preg_replace('/(&nbsp;|\s)+/', '', $topicTitle);

            //  supprime toutes les balises HTML
            $strimmedTopicTitle = strip_tags(html_entity_decode($trimmedTopicTitle));

            // on vérifie si le topic de l'utilisateur n'existe pas déjà en bdd (par le title)
            $topicExists = $topicManager->findOneBy("title", $topicTitle);

            // si après trim et strip il ne reste plus rien, on ne créer pas le topic
            if (!empty($strimmedTopicTitle)) {
                // si le topic passe les filtres et n'excède pas 20 caractères,
                if ($topicTitle && strlen($topicTitle) <= 20) {
                    // si le topic n'existe pas déjà en bdd (par le title)
                    if (!$topicExists) {
                        $topicManager->editTopic($id, $topicTitle);
                        Session::addFlash("success", "Topic succesfully modified");
                        $this->redirectTo("security", "topicDashboard&id=$id");
                    } else {
                        Session::addFlash("error", "Topic name already used");
                        $this->redirectTo("security", "topicDashboard&id=$id");    
                    }
                } else {
                    Session::addFlash("error", "Incorrect topic name");
                    $this->redirectTo("security", "topicDashboard&id=$id");
                }
            } else {
                Session::addFlash("error", "Incorrect topic name");
                $this->redirectTo("security", "topicDashboard&id=$id");
            }
        } else {
            $this->redirectTo("home");
        }
    }

    public function deleteTopic($id)
    {
        $topicManager = new topicManager();
        $topicManager->delete($id);

        Session::addFlash("success", "Topic succesfully deleted");
        $this->redirectTo("security", "topicsDashboard");
    }

    public function createTopic()
    {
        if(isset($_POST['submit'])) {

            $topicTitle = filter_input(INPUT_POST, 'topicTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // on instancie un objet de classe TopicManager pour utiliser ses méthodes dans les vérifications
            $topicManager = new TopicManager();

            // vérification du topic (si il n'est pas vide avec que des espaces)
            // supprime les espaces spéciaux et les espaces vides du message
            $trimmedTopicTitle = preg_replace('/(&nbsp;|\s)+/', '', $topicTitle);

            //  supprime toutes les balises HTML
            $strimmedTopicTitle = strip_tags(html_entity_decode($trimmedTopicTitle));

            // on vérifie si le topic de l'utilisateur n'existe pas déjà en bdd (par le title)
            $topicExists = $topicManager->findOneBy("title", $topicTitle);

            // si après trim et strip il ne reste plus rien, on ne créer pas le post
            if (!empty($strimmedTopicTitle)) {
                // si le topic passe les filtres et n'excède pas 20 caractères
                if ($topicTitle && strlen($topicTitle) <= 20) {
                    // si le topic n'existe pas déjà en bdd (par le title)
                    if (!$topicExists) {
                        $topicManager->createTopic($topicTitle);
                        Session::addFlash("success", "Topic succesfully created");
                        $this->redirectTo("security", "topicsDashboard");
                    } else {
                        Session::addFlash("error", "Topic name already used");
                        $this->redirectTo("security", "topicsDashboard");
                    }
                } else {
                    Session::addFlash("error", "Incorrect topic name");
                    $this->redirectTo("security", "topicsDashboard");
                }
            } else {
                Session::addFlash("error", "Incorrect topic name. ");
                $this->redirectTo("security", "topicDashboard");
            }
        } else {
            $this->redirectTo("home");
        }
    }
}
