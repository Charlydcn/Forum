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

        public function signIn() {

        }

        public function register() {
            if(isset($_GET['action'])) {

                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($username && $email && $pass1 && $pass2) {
                    // var_dump('ok');die;
                    $userManager = new UserManager();
                    $user = $userManager->findOneBy('email', $email);
                    if ($user) {
                        // utilisateur existe déjà en bdd
                        $this->addFlash("error", "An account with this email already exists");
                        $this->redirectTo("security", "displayRegister");
                    } else {
                        // utilisateur n'existe pas en bdd
                        
                    }
                }

            }
        }

        public function displayRegister(){
             return [
                "view" => VIEW_DIR."security/register.php",
             ];
         
        }

    }
