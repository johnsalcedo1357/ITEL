<?php
class Car {
    public $make;
    public $model;
    function __construct($a, $b)
    {
    global $make,$model;
    $this->$make = $a;
    $this->$model = $b;
    }
    function getDescription(){
        return $this->$make . " " . $this->$model;
    }
}
$car = new Car("Toyota", "Yamaha");
$car->getDescription();
?>