<?php


use Classes\ArgumentHelper;
use PHPUnit\Framework\TestCase;

class ArgumentHelperTest extends TestCase
{
    public function testMissingArguments(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ArgumentHelper::getStock(1, []);
    }

    public function testInvalidJsonArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid json!');
        ArgumentHelper::getStock(2, ['filename.php', '1=1']);
    }

    public function testValidStock(): void
    {
        $stock = ArgumentHelper::getStock(2, ['filename.php', '{"1":2,"2":3,"3":1}']);
        $this->assertEquals(json_decode('{"1":2,"2":3,"3":1}'), $stock, 'Invalid stock data!');
    }
}
