<?php

use Classes\Table;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{
    public function testDrawing(): void
    {
        $expected = "ID                  NAME                \n========================================\n1                   ProductName         \n";
        ob_start();
        Table::draw(['id', 'name'], [['1', 'ProductName']]);
        $this->assertEquals($expected, ob_get_clean());
    }
}
