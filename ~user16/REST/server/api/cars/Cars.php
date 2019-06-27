<?php

//namespace api\cars;
include_once '../../libs/RestServer.php';
include_once '../../libs/CarService.php';
//require_once '../../autoload.php';

class Cars 
{
  private $service;
  
  function __construct()
  {
    $this->service = new CarService();
  }
/*
  function getCars($arrParams)
  {
    if('' !== $attrs[0]  && 0 != intval($attrs[0]))
    {
      return $this->getByID((int)$attrs[0]);
    }
    return $this->service->getAllCars();
  }
  */
  public function getCarByID($id)
  {
    $rez=$this->service->getCarByID($id);//[0];// что значит 0 в квадратных скобочках?
    $rez=json_decode($rez);
    return $rez;
  }
  
  public function getCarsByParams($arrParams)
  {
    return $this->service->CarFilter($this->getData());
  }

  public function getAllCars()
  {
    $rez=$this->service->getAllCars();
    $rez=json_decode($rez);
    return $rez;
  }
  

}
