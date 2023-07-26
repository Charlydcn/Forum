<?php

namespace Model\Entities;

use App\Entity;

final class Post extends Entity
{

        private $id;
        private $title;
        private $content;
        private $creationDate;
        private $modificationDate;
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

        public function getCreationDate()
        {
            $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setCreationDate($creationDate)
        {
            $this->creationDate = new \DateTime($creationDate);
            return $this;
    }

        // MODIFICATION DATE *********************************************************************

        public function getModificationDate()
        {
            if ($this->modificationDate instanceof \DateTime) {
                    return $this->modificationDate->format("d/m/Y, H:i:s");
            } else {
                    return null;
            }
    }


        public function setModificationDate($modificationDate)
        {
            $this->modificationDate = $modificationDate ? new \DateTime($modificationDate) : null;
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
