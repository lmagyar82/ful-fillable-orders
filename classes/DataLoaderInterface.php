<?php
namespace Classes;

interface DataLoaderInterface {
    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return array
     */
    public function getHeader():array;
}