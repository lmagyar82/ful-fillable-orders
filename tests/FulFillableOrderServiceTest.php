<?php

use Classes\CsvDataProvider;
use Classes\FulFillableOrderService;
use PHPUnit\Framework\TestCase;

class FulFillableOrderServiceTest extends TestCase
{
    /** @var array */
    private $csvContent;
    /** @var object */
    private $stock;

    public function setUp(): void
    {
        $this->csvContent = new CsvDataProvider('tests/test.csv');
        $this->stock = json_decode('{"1":2,"2":3,"3":1}');
    }

    public function testProcess(): void
    {
        $expected = [
            ["product_id" => "1", "quantity" => "2", "priority" => "HIGH", "created_at" => "2021-03-25 14:51:47"],
            ["product_id" => "2", "quantity" => "1", "priority" => "MEDIUM", "created_at" => "2021-03-21 14:00:26"],
            ["product_id" => "3", "quantity" => "1", "priority" => "MEDIUM", "created_at" => "2021-03-22 12:31:54"],
            ["product_id" => "2", "quantity" => "2", "priority" => "LOW", "created_at" => "2021-03-24 11:02:06"],
            ["product_id" => "1", "quantity" => "1", "priority" => "LOW", "created_at" => "2021-03-25 19:08:22"]
        ];
        $service = new FulFillableOrderService($this->csvContent);
        $result = $service->getProcessedData($this->stock);
        $this->assertEquals($expected, $result, "Wrong results!");
    }

    public function testProcessWithEmptyStock(): void
    {
        $service = new FulFillableOrderService($this->csvContent);
        $result = $service->getProcessedData((object) json_decode('[]'));
        $this->assertEquals([], $result, "Wrong results!");
    }

    public function testProcessWithEmptyData(): void
    {
        $service = new FulFillableOrderService(new CsvDataProvider('tests/testEmptyRows.csv'));
        $result = $service->getProcessedData($this->stock);
        $this->assertEquals([], $result, "Wrong results!");
        $this->assertEquals(['product_id', 'quantity', 'priority', 'created_at'], $service->getHeader());
    }

    public function testProcessWrongPriority(): void
    {
        $this->expectException(Exception::class);
        $service = new FulFillableOrderService(new CsvDataProvider('tests/testPriority.csv'));
        $result = $service->getProcessedData($this->stock);
    }
}
