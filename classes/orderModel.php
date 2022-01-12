<?php

class orderModel
{
    private $ordersData;

    function __construct()
    {
        $row = 1;
        $ordersH = [];
        if (($handle = fopen(__DIR__ . '/../orders.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                if ($row == 1) {
                    $ordersH = $data;
                } else {
                    $o = [];
                    for ($i = 0; $i < count($ordersH); $i++) {
                        $o[$ordersH[$i]] = $data[$i];
                    }
                    $this->ordersData[] = $o;
                }
                $row++;
            }
            fclose($handle);
        }
    }

    function getAll()
    {
        return $this->ordersData;
    }
}