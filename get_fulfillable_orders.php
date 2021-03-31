<?php

use Classes\ArgumentHelper;
use Classes\CsvDataProvider;
use Classes\FulFillableOrderService;
use Classes\Table;

require __DIR__ . '/vendor/autoload.php';

$dataLoader = new CsvDataProvider('orders.csv');
$orderService = new FulFillableOrderService($dataLoader);

Table::draw($orderService->getHeader(), $orderService->getProcessedData(ArgumentHelper::getStock($argc, $argv)));
