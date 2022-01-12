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

    /**
     * create the output for command line
     */
    public function printOutput()
    {
        foreach ($this->ordersHeader as $h) {
            echo str_pad($h, 20);
        }
        echo "\n";
        foreach ($this->ordersHeader as $h) {
            echo str_repeat('=', 20);
        }
        echo "\n";

        foreach ($this->orderDataAll as $item) {            
            foreach ($this->ordersHeader as $h) {
                if ($h == 'priority') {
                    if ($item['priority'] == 1) {
                        $text = 'low';
                    } else {
                        if ($item['priority'] == 2) {
                            $text = 'medium';
                        } else {
                            $text = 'high';
                        }
                    }
                    echo str_pad($text, 20);
                } else {
                    echo str_pad($item[$h], 20);
                }
            }
            echo "\n";
            
        }
    }
}