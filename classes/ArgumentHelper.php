<?php

namespace Classes;

use Exception;
use InvalidArgumentException;

class ArgumentHelper
{
    /**
     * @param int $argc
     * @param array $argv
     * @throws Exception
     */
    public static function getStock(int $argc, array $argv): object
    {
        if ($argc != 2) {
            throw new InvalidArgumentException("Ambiguous number of parameters!");
        }
        $stock = json_decode($argv[1]);
        if (empty($stock)) {
            throw new InvalidArgumentException("Invalid json!");
        }

        return $stock;
    }
}
