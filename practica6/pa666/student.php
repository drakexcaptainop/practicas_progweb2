<?php
    require 'dbutil.php';
    require 'person.php';

    class Student extends Person {
        private int $semester;
        
        public function __construct($firstName = null, $lastName = null, $city = null, $semester = 0, $id = null) {
            parent::__construct($id, $firstName, $lastName, $city);
            $this->semester = $semester;
            $this->pdo = DBUtil::getConnection();
        }
        
        public function findAll() {
            $result = $this->pdo->query("SELECT id, first_name AS firstName, last_name AS lastName, city, semester FROM student");
            $students = array();
            
            while ($row = $result->fetch()):
                array_push($students, $row);
            endwhile;
            
            return $students;
        }
        
        public function findById($id) {
            $stmt = $this->pdo->prepare("SELECT id, first_name AS firstName, last_name AS lastName, city, semester FROM student WHERE id=:id");
            $stmt->execute(array("id" => $id));
            $student = null;
            
            if ($row = $stmt->fetch()) {
                $student = $row;
            }
            
            return $student;
        }
        
        public function save() {
            try {
                $stmt = $this->pdo->prepare("INSERT INTO student(first_name, last_name, city, semester) VALUES (:first_name, :last_name, :city, :semester)");
                $stmt->execute(array(
                    "first_name" => $this->firstName,
                    "last_name" => $this->lastName,
                    "city" => $this->city,
                    "semester" => $this->semester
                ));
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            
            return 0;
        }
        
        public function update() {
            try {
                $stmt = $this->pdo->prepare("UPDATE student set first_name=:first_name, last_name=:last_name, city=:city, semester=:semester WHERE id=:id");
                $stmt->execute(array(
                    "id" => $this->id,
                    "first_name" => $this->firstName,
                    "last_name" => $this->lastName,
                    "city" => $this->city,
                    "semester" => $this->semester
                ));
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            
            return 0;
        }
        
        public function delete() {
            try {
                $stmt = $this->pdo->prepare("DELETE FROM student WHERE id=:id");
                $stmt->execute(array(
                    "id" => $this->id
                ));
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            
            return 0;
        }
    }
