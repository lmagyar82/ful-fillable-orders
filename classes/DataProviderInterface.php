<?php
namespace Classes;

interface DataProviderInterface
{
    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return array
     */
    public function getHeader():array;
}
