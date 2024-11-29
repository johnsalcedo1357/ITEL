<?php
require_once './person.php';

class student extends Person {
    private string $course;
    function __construct($name,$age,$course){
        parent::__construct($name,$age);
        $this->course = $course;
    }
    function displayInfo(){
        echo "Sup my niggas my name is " . $this->getName() . ", I'm " . $this->getAge() . " years old and I'm a student of $this->course";
    }

    function getCourse(){
        return $this->course;
    }
}

?>