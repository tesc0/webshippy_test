<?php
//how many parameters have been added
if ($argc != 2) {
    echo 'Ambiguous number of parameters!';
    exit(1);
}

//check for input data
$stockInput = json_decode($argv[1]);
if(empty($stockInput)) {
    echo 'Invalid json!';
    exit(1);
}

require_once __DIR__ . '/classes/orderController.php';
$orderController = new orderController();

//filter the array
$orderController->filterOrderDataByStock($stockInput);
//sort by priority and date
$orderController->sortOrderData();
//show
$orderController->printOutput();