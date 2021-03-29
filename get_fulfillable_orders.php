<?php
require __DIR__ . '/vendor/autoload.php';

$stock = \Classes\ArgumentHelper::getStock($argc, $argv);
$dataLoader = new \Classes\CsvDataLoader('orders.csv');


$orders = $dataLoader->getData();
$ordersH = $dataLoader->getHeader();

usort($orders, function ($a, $b) {
    $pc = -1 * ($a['priority'] <=> $b['priority']);
    return $pc == 0 ? $a['created_at'] <=> $b['created_at'] : $pc;
});

\Classes\Table::draw($ordersH, $orders, $stock);
