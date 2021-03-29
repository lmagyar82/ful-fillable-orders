<?php

namespace Classes;

class Table
{
    /**
     * @param $header
     * @param $data
     */
    public static function draw($ordersH, $orders, $stock)
    {
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
    }
}