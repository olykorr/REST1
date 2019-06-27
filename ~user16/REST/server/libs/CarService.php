<?php
//namespace libs\services;

include_once 'SQLRequests.php';
include_once 'MysqlRequests.php';
include_once 'config.php';

class CarService 
{
    private $pdo;

    public function __construct()
    {
        $this->ExecuteDBRequest = new MysqlRequests();
    }

    public function getAllCars()
    {
		$results = $this->ExecuteDBRequest
					->MySelect(array('id','brand', 'model', 'year', 'engine', 'color', 'max_speed', 'price'))
					->setTable('cars')
					->buildQery()->exec();
		if (false === $results)
        {
            echo "error";
        }
		return $results;
    }
  
    public function getCarByID($id)
    {
        $results = $this->ExecuteDBRequest
					->MySelect(array('brand','id', 'model', 'year', 'engine', 'color', 'max_speed', 'price'))
					->setTable('cars')
					->where('id','=',':id')
					->setParam(array('id' => $id))
					->buildQery()->exec();

		if (false === $results)
        {
            echo "error";
        }
        return $results;
    }
  
    public function getCarsByParams($arrParams)
    {
       $arrParams=json_decode($arrParams, JSON_OBJECT_AS_ARRAY);
       $this->ExecuteDBRequest
					->MySelect(array('id','brand', 'model', 'year', 'engine', 'color', 'max_speed', 'price'))
					->setTable('cars');

		if(!empty($arrParams['year']))
        {
            $this->ExecuteDBRequest
				 ->where('year','=',':year')
				 ->setParam(array('year' => $arrParams['year']));
        }

		if (!empty($arrParams['brand']))
        {
			 $this->ExecuteDBRequest
					->where('brand','=',':brand')
					->setParam(array('brand' => $arrParams['brand']));
        }

        if (!empty($arrParams['model']))
        {
			  $this->ExecuteDBRequest
					->where('model','=',':model')
					->setParam(array('model' => $arrParams['model']));
		}

        if (!empty($arrParams['engine']))
        {
			  $this->ExecuteDBRequest
					->where('engine','=',':engine')
					->setParam(array('engine' => $arrParams['engine']));
		}

        if (!empty($arrParams['color']))
        {
			$this->ExecuteDBRequest
					->where('color','=',':color')
					->setParam(array('color' => $arrParams['color']));
		}

        if (!empty($arrParams['max_speed']))
        {
			 $this->ExecuteDBRequest
					->where('max_speed','=',':max_speed')
					->setParam(array('max_speed' => $arrParams['max_speed']));
		}

        if (!empty($arrParams['price']))
        {
			 $this->ExecuteDBRequest
					->where('price','=',':price')
					->setParam(array('price' => $arrParams['price']));
		}

	   $results = $this->ExecuteDBRequest
					->buildQery()->exec();

		if (false === $results)
        {
            throw new SoapFault('Server', ERR_QUERY);
        }
        return $results;
    }
}