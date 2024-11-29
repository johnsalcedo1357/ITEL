<?php
require_once 'animal.php';
require_once 'airanimal.php';
class Bird implements Animal, airAnimal{
    public $name;
    public $breed;
    public function __construct($name, $breed)
    {
        $this->name = $name;
        $this->breed = $breed;
    }
    public function makeSound(){
        echo "I am KFC <br>";
    }

    public function canFly(){
        echo "Skyline Pigeon flyyyyy";
    }
}
?>