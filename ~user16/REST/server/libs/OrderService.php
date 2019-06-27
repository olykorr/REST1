<?php

    include_once 'SQLRequests.php';
    include_once 'MysqlRequests.php';
    include_once 'config.php';

    class OrderService 
    {
        private $pdo;

        public function __construct()
        {
            $this->ExecuteDBRequest = new MysqlRequests();
        }

        public function createOrder($arrParams)
        { 
            //$data = (array)$order;
            $arrParams = json_decode($arrParams, JSON_OBJECT_AS_ARRAY);
            if (!empty($arrParams['id_car']) && !empty($arrParams['f_name']) && !empty($arrParams['l_name']) && !empty($arrParams['payment']))
            {
                $rez = $this->ExecuteDBRequest
                                ->MyInsert(array('id_car'=>$arrParams['id_car'] , 'f_name'=>$arrParams['f_name'],'l_name'=>$arrParams['l_name'],'payment'=>$arrParams['payment']))
                                ->setTable('orders')
                                ->buildQery()->exec();
                $rez=json_decode($rez);
                return $rez;
            }
            else
            {
                echo "error";
            }
        }


        public function getOrders($param)
        {
            if (empty($param['id']))
            {
                return false;
            }
            
            $results = $this->ExecuteDBRequest
					->MySelect(array('orders.id','cars.brand', 'cars.model', 'cars.price', 'orders.status', 'color', 'max_speed', 'price'))
					->setTable('orders')
					->where('id','=',':id')
					->setParam(array('id' => $id))
					->buildQery()->exec();


            /*$sql = "SELECT orders.id, cars.brand, cars.model, cars.price, orders.status".
                " FROM orders, cars WHERE orders.id_car=cars.id AND orders.id_user=".$id_user;
            */
            if (false === $result)
            {
                return ERR_QUERY;
            }

            //$data = $sth->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data))
            {
                return ERR_SEARCH;
            }
            return $data;
        }
    /*
        public function addOrder($param)
        {
            if (empty($param))
            {
                return false;
            }
            $id_car = $this->pdo->quote($param['id_car']);
            $id_user = $this->pdo->quote($param['id_user']);
            $status = '\'sent\'';
            $sql = "INSERT INTO orders (id_car, id_user, status) VALUES (".$id_car.", ".$id_user.", ".$status.")";
            $count = $this->pdo->exec($sql);
            if ($count === false)
            {
    //            throw new PDOException(ERR_QUERY);
                return ERR_QUERY;
            }
            return $count;
        }*/
    
        /*
        public function changeStatus($param)
        {
            if (empty($param['id']) && empty($param['status']))
            {
                return false;
            }
            if ($param['status'] !== 'sent' && $param['status'] !== 'received')
            {
                return false;
            }
            $id = $this->pdo->quote($param['id']);
            $status = $this->pdo->quote($param['status']);
            $sql = "UPDATE orders SET status=".$status." WHERE id=".$id;
            $count = $this->pdo->exec($sql);
            return $count;
        }*/
       