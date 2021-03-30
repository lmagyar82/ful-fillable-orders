<?php

use Classes\ArgumentHelper;
use Classes\CsvDataProvider;
use Classes\FulFillableOrderService;
use Classes\Table;

require __DIR__ . '/vendor/autoload.php';

$dataLoader = new CsvDataProvider('orders.csv');
$orderService = new FulFillableOrderService($dataLoader, ArgumentHelper::getStock($argc, $argv));

Table::draw($orderService->getHeader(), $orderService->getProcessedData());
