<?php
class Person {
    private $name, $age;
    function __construct($name, $age){
        $this->name = $name;
        $this->age = $age;
    }
    function displayInfo(){
        echo "Sup my niggas my name is $this->name, I'm $this->age years old.";
    }

    function getName(){
        return $this->name;
    }

    function getAge(){
        return $this->age;
    }
}
?>