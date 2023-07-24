<?php

namespace Model\Entities;

use App\Entity;

final class Post extends Entity
{

        private $id;
        private $content;
        private $creationDate;
        private $topic;
        private $user;

        public function __construct($data)
        {
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

        // DATE *********************************************************************

        public function getcreationDate()
        {
                $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
                return $formattedDate;
        }

        public function setcreationDate($creationDate)
        {
                $this->creationDate = new \DateTime($creationDate);
                return $this;
        }

        // TOPIC *********************************************************************

        public function getTopic()
        {
                return $this->topic;
        }

        public function setTopic($topic)
        {
                $this->topic = $topic;

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
