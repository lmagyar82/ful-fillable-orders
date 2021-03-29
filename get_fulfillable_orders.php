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

foreach ($ordersH as $h) {
    echo str_pad($h, 20);
}
echo "\n";
foreach ($ordersH as $h) {
    echo str_repeat('=', 20);
}
echo "\n";
foreach ($orders as $item) {
    if ($stock->{$item['product_id']} >= $item['quantity']) {
        foreach ($ordersH as $h) {
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
