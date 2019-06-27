<?php

include_once("Cars.php");
echo "Cars";

$car=new Cars();
$rez = $car->getAllCars();
$rez1 = $car->getCarByID(1);
var_dump($rez);
var_dump($rez1);
//include ('../../libs/Sql.php');

