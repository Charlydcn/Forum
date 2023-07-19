<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $email;
        private $username;
        private $password;
        private $role;
        private $registrationDate;

        public function __construct($data){         
            $this->hydrate($data);        
        }


        // ID *********************************************************************
        
        public function getId()
        {
                return $this->id;
        }

        
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        // EMAIL *********************************************************************

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        // USERNAME *********************************************************************

        public function getUsername()
        {
                return $this->username;
        }
 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        // PASSWORD *********************************************************************

        public function getPassword()
        {
                return $this->password;
        }
 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        // ROLE *********************************************************************

        public function getRole()
        {
                return $this->role;
        }
 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        // DATE *********************************************************************

        public function getRegistrationDate(){
            $formattedDate = $this->registrationDate->format("d/m/Y");
            return $formattedDate;
        }

        public function setRegistrationDate($registrationDate){
            $this->registrationDate = new \DateTime($registrationDate);
            return $this;
        }
    }