<?php
    require_once 'person.php';
    require_once 'student.php';
    require_once 'abstraction/dog.php';
    require_once 'abstraction/animal.php';
    require_once 'abstraction/cat.php';
    require_once 'abstraction/bird.php';

$person = new Person("Ronelo", 24);
$student = new Student("Ronelo", 24, "BSIT");
$person->displayInfo();
echo "<br>";
$student->displayInfo();
echo "<br>";
echo "<br>";
echo "<br>";
$chinese_food = new Dog('Speed', 'Chihuahua');
$chinese_food->makeSound();
$chinese_food->displayInfo();

$chinese_food2 = new Cat('Wet ass pussy', 'Sphynx');
$chinese_food2->makeSound();
$chinese_food2->displayInfo();

$nigger_food = new Bird('KFC', 'Chicken');
$nigger_food->makeSound();
?>