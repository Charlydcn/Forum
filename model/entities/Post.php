<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $user;
        private $content;
        private $date;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        // TITLE *********************************************************************
        
        public function getId()
        {
                return $this->id;
        }
        
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        // CONTENT *********************************************************************

        public function getContent()
        {
                return $this->content;
        }

        public function setContent($content)
        {
                $this->content = $content;

                return $this;
        }

        // USER *********************************************************************

        public function getUser()
        {
                return $this->user;
        }
 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        // DATE *********************************************************************

        public function getDate(){
            $formattedDate = $this->date->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDate($date){
            $this->date = new \DateTime($date);
            return $this;
        }
    }