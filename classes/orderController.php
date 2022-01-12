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

    /**
     * sort the order by priority and creation date
     */
    public function sortOrderData()
    {
        usort($this->orderDataAll, function ($a, $b) {
            $pc = -1 * ($a['priority'] <=> $b['priority']);
            return $pc == 0 ? $a['created_at'] <=> $b['created_at'] : $pc;
        });
    }

    /**
     * filter the list of the orders
     * 
     * @stock: json object, product id with minimum quantity
     */
    public function filterOrderDataByStock($stock)
    {
        foreach($this->orderDataAll as $index => $item) {
            if ($stock->{$item['product_id']} < $item['quantity']) {
                unset($this->orderDataAll[$index]);
            }
        }
        $this->orderDataAll = array_values($this->orderDataAll);
    }
}