<?php

if ($argc != 2) {
    echo 'Ambiguous number of parameters!';
    exit(1);
}

require_once __DIR__ . '/class/orderController.php';

$orderController = new orderController();

//check for input data
$stockInput = json_decode($argv[1]);
if(empty($stockInput)) {
    echo 'Invalid json!';
    exit(1);
}

//filter the array
$orderController->filterOrderDataByStock($stockInput);
//sort by priority and date
$orderController->sortOrderData();