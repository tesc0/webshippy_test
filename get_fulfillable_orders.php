<?php

if ($argc != 2) {
    echo 'Ambiguous number of parameters!';
    exit(1);
}

require_once __DIR__ . '/class/orderController.php';

$orderController = new orderController();