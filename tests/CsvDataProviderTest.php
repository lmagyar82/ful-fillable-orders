<?php
declare(strict_types=1);

use Classes\CsvDataProvider;
use PHPUnit\Framework\TestCase;

final class CsvDataProviderTest extends TestCase
{
    public function testFileNotFound(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/File not found/');
        new CsvDataProvider('notexists.csv');
    }

    public function testFileOpenedAndHasNoData(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Data not found/');
        $csv = new CsvDataProvider('tests/testEmptyFile.csv');
        $csv->getData();
    }

    public function testFileOpenedAndHasDataWithHeader(): void
    {
        $csv = new CsvDataProvider('tests/test.csv');
        $this->assertNotEmpty($csv->getData());
        $this->assertNotEmpty($csv->getHeader());
    }
}
