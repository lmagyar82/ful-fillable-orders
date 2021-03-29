<?php

namespace Classes;

class Table
{
    const SIZE = 20;

    /**
     * @param $header
     * @param $data
     */
    public static function draw($header, $data)
    {
        self::drawRow($header, true);

        self::drawLine($header);

        foreach ($data as $row) {
            self::drawRow($row);
        }
    }

    /**
     * @param array $row
     * @param bool $isUpper
     */
    private static function drawRow(array $row, bool $isUpper = false)
    {
        foreach ($row as $column) {
            echo str_pad($isUpper ? strtoupper($column) : $column, self::SIZE);
        }
        echo "\n";
    }

    /**
     * @param array $header
     */
    private static function drawLine(array $header)
    {
        foreach ($header as $h) {
            echo str_repeat('=', self::SIZE);
        }
        echo "\n";
    }
}