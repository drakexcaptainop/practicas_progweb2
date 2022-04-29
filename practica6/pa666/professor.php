<?php
    require 'dbutil.php';
    require 'person.php';

    class Professor extends Person {
        private $salary;
        
        /**
            Complete the Professor class implementation
            in a similar way to students
        */
        
        public function __construct($firstName = null, $lastName = null, $city = null, $salary = 0, $id = null) {
            parent::__construct($id, $firstName, $lastName, $city);
            $this->salary = $salary;
            $this->pdo = DBUtil::getConnection();
        }
        
        public function findAll() {
            $q = $this->pdo->query("SELECT id, first_name as firstName, last_name as lastName, city, salary FROM professor");
            $res = array();
            while ($r=$q->fetch()){
                array_push($res, $r);
            }
            return $res;
        }
        
        public function findById() {
            $q = $this->pdo->prepare("SELECT id, first_name as firstName, last_name as lastName, city, salary FROM professor WHERE id = :id");
            $q->execute(array("id"=>$this->id));
            $s = null;
            if($r=$q->fetch()){
                $s = $r;
            }
            return $s;
        }
        
        public function save() {
            $q = $this->pdo->prepare("INSERT INTO professor (first_name, last_name, city, salary) VALUES(:fName, :lName, :city, :salary)");
            $q->execute(array("fName"=>$this->firstName, "lName"=> $this->lastName, "city"=>$this->city, "salary"=>$this->salary));
            return 0;
        }
        
        public function update() {
            $q = $this->pdo->prepare("UPDATE professor SET first_name = :fName, last_name = :lName, city = :city, salary = :salary WHERE id = :id");
            $q->execute(array("fName"=>$this->firstName,"lName"=>$this->lastName,"city"=>$this->city,"salary"=>$this->salary, "id"=>$this->id));
            return 0;
        }
        
        public function delete() {
            $q = $this->pdo->prepare("DELETE FROM professor WHERE id = :id");
            $q->execute(array("id"=>$this->id));
            return 0;
        }
    }
