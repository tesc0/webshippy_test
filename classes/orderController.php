<?php

require_once __DIR__ . '/orderModel.php';

class orderController
{
    private $orderDB;
    private $ordersHeader = [];

    function __construct()
    {
        $this->orderDB = new orderModel();
        //load all data
        $this->orderDataAll = $this->orderDB->getAll();

        //set headers
        $this->getOrderDataHeader();
    }

    /**
     * get all the headers into array
     */
    public function getOrderDataHeader()
    {
        foreach($this->orderDataAll as $index => $item) {
            if(empty($this->ordersHeader)) {
                foreach($item as $label => $value) {
                    $this->ordersHeader[] = $label;
                }
            }
            break;
        }
    }
}