<?php
    abstract class Person {
        protected $id;
        protected $firstName;
        protected $lastName;
        protected $city;
        
        public function __construct($id, $firstName, $lastName, $city) {
            $this->id = $id;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->city = $city;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
        }

        public function getCity() {
            return $this->city;
        }

        public function setCity($city) {
            $this->city = $city;
        }
    }