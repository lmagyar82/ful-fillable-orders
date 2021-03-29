<?php

namespace Classes;

class FullFillableOrderService
{
    const PRIORITY_LOW = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH = 3;

    /** @var DataProviderInterface $dataLoader */
    private $dataLoader;
    /** @var array $header */
    private $header;
    /** @var array $data */
    private $data;
    /** @var object $stock */
    private $stock;

    /**
     * @param DataProviderInterface $dataLoader
     * @param object $stock
     */
    public function __construct(DataProviderInterface $dataLoader, object $stock)
    {
        $this->dataLoader = $dataLoader;
        $this->setData($this->dataLoader->getData());
        $this->setHeader($this->dataLoader->getHeader());
        $this->sortByPriorityAndDate();
        $this->setStock($stock);
    }

    /**
     * @param int $value
     * @return string
     */
    private function getPriorityText(int $value): string
    {
        switch ($value) {
            case self::PRIORITY_HIGH: return 'HIGH';
            case self::PRIORITY_MEDIUM: return 'MEDIUM';
            case self::PRIORITY_LOW: return 'LOW';
        }

        return (string) $value;
    }

    private function sortByPriorityAndDate(): void
    {
        usort($this->data, function ($a, $b) {
            $pc = -1 * ($a['priority'] <=> $b['priority']);
            return $pc == 0 ? $a['created_at'] <=> $b['created_at'] : $pc;
        });
    }

    /**
     * @return array
     */
    public function getProcessedData(): array
    {
        $result = [];
        foreach ($this->getData() as $item) {
            if (isset($this->getStock()->{$item['product_id']}) && $this->getStock()->{$item['product_id']} >= $item['quantity']) {
                $item['priority'] = $this->getPriorityText($item['priority']);
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array $header
     */
    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return object
     */
    public function getStock(): object
    {
        return $this->stock;
    }

    /**
     * @param object $stock
     */
    public function setStock(object $stock): void
    {
        $this->stock = $stock;
    }
}
