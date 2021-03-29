<?php

use Classes\ArgumentHelper;
use Classes\CsvDataProvider;
use Classes\FullFillableOrderService;
use Classes\Table;

require __DIR__ . '/vendor/autoload.php';

$dataLoader = new CsvDataProvider('orders.csv');
$orderService = new FullFillableOrderService($dataLoader, ArgumentHelper::getStock($argc, $argv));

Table::draw($orderService->getHeader(), $orderService->getProcessedData());
