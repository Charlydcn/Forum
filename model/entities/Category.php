<?php

namespace Model\Entities;

use App\Entity;

final class Category extends Entity
{

        private $id;
        private $name;

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

        // NAME *********************************************************************

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }
}
