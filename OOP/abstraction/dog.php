<?php
require_once 'animal.php';
require_once 'landanimal.php';
class Dog implements Animal, landAnimal {
    public $name;
    public $breed;

    public function __construct($name, $breed)
    {
        $this->name = $name;
        $this->breed = $breed;
    }

    public function canWalk(){
        echo "nigga I can walk <br>";
    }
    
    public function makeSound(){
        echo "nigga <br>";
    }

    public function displayInfo(){
        echo "wassup nigga My name is " . $this->name . ", and I'm a " . $this->breed . "<br>";
    }
}
?>