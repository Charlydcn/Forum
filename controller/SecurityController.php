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

            if ($username && $email && $role) {

                $userManager = new UserManager();

                // on vérifie si le mot de passe a été changé (si il ne l'a pas été, le form renverra un string(0))
                if (strlen($pass1) > 8 && strlen($pass2) > 8) {

                    // et si il l'a été, on modifie la bdd en re-hashant le nouveau mot de passe
                    if ($pass1 === $pass2 && strlen($pass1) <= 25) {
                        $password = password_hash($pass1, PASSWORD_DEFAULT);

                        $userManager->editUserPassword($id, $password);
                    } else {
                        Session::addFlash("error", "Password error");
                        $this->redirectTo("forum", "userDetails", $id);
                    }
                }

                // modification du reste des données de l'utilisateurs
                $userManager->editUser($id, $username, $email, $role);
                $user = $userManager->findOneById($id);

                if ($_SESSION['user']->getId() === $user->getId()) {
                    unset($_SESSION['user']);
                    Session::setUser($user);
                }

                Session::addFlash("success", "User succesfully modified");
                $this->redirectTo("forum", "userDetails", $id);
            }
        }
    }

    public function deleteUser($id)
    {
        $userManager = new UserManager();
        $userManager->delete($id);
        unset($_SESSION['user']);

        Session::addFlash("success", "User succesfully deleted");
        $this->redirectTo("home");
    }

    public function categoriesDashboard()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

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
            
            if ($categoryName) {
                $category = new CategoryManager();
                $category->editCategory($id, $categoryName);
                Session::addFlash("success", "Category succesfully modified");
                $this->redirectTo("security", "categoryDashboard&id=$id");
            } else {
                Session::addFlash("error", "Incorrect category name");
                $this->redirectTo("security", "categoryDashboard&id=$id");
            }

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
            
            if($categoryName) {
                $category = new CategoryManager();
                $category->createCategory($categoryName);
                Session::addFlash("success", "Category succesfully created");
                $this->redirectTo("security", "categoriesDashboard");
            } else {
                Session::addFlash("error", "Incorrect category name");
                $this->redirectTo("security", "categoriesDashboard");
            }


        }
    }

    public function createPost($id)
    {
        // var_dump(htmlspecialchars_decode(htmlentities($a)));die; A LA SORTIE
        // var_dump(htmlspecialchars($_POST["textarea"]));die; A L'ENTREE
        if(isset($_POST['submit'])) {
            $newPost = filter_input(INPUT_POST, 'newPost', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
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
}
