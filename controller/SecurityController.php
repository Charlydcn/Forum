<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{
        
        public function index() {}

        public function displayRegister(){
            return [
               "view" => VIEW_DIR."security/register.php",
            ];
       }

        public function register() {
            if(isset($_GET['action'])) {

                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                if($username && $email && $pass1 && $pass2) {
                    
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
                            if($userUsername) {
                                Session::addFlash("error", "Username already taken");
                                $this->redirectTo("security", "displayRegister");   

                            } else {
                                // ajout en bdd                               
                                $userManager->add(['username' => $username, 'password' => $password, 'email' => $email]);
                                
                                Session::addFlash("success", "Account successfully created !");        
                                $this->redirectTo("forum", "Categories");
                            }                          
                        }
                    } else {
                        // les passwords ne matchent pas
                        Session::addFlash("error", "Passwords don't match !");
                        $this->redirectTo("security", "displayRegister");
                    }             
                }
            }

        }

        public function logIn() {

        }



    }
