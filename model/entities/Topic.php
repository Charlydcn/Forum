<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $title;
        private $creationDate;
        private $closed;
        private $category;
        private $user;

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

        // TITLE *********************************************************************
        
        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }
        
        // DATE *********************************************************************

        public function getcreationDate(){
                $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setcreationDate($creationDate){
                $this->creationDate = new \DateTime($creationDate);
                return $this;
        }
        
        // CLOSED *********************************************************************
        
        public function getClosed()
        {
                return $this->closed;
        }
        
        public function setClosed($closed)
        {
                $this->closed = $closed;
                
                return $this;
        }
        
        // CATEGORY *********************************************************************

        public function getCategory()
        {
                return $this->category;
        }
        
        public function setCategory($category)
        {
                $this->category = $category;
                
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
        
}
