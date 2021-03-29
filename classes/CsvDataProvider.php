<?php

namespace Classes;

class CsvDataProvider implements DataProviderInterface
{

    /** @var string $fileName */
    private $fileName;

    /** @var array $file */
    private $file;

    /** @var array $header */
    private $header;

    /**
     * CsvDataLoader constructor.
     * @param string|null $fileName
     */
    public function __construct(string $fileName = null)
    {
        if (!empty($fileName)) {
            $this->setFileName($fileName);
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $csv = array_map('str_getcsv', $this->getFile());
        $this->setHeader($csv[0]);
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($this->getHeader(), $a);
        });
        array_shift($csv);

        return $csv;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        if (empty($this->header)) {
            $this->getData();
        }

        return $this->header;
    }


    /**
     * @param string $fileName
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return array
     */
    private function getFile(): array
    {
        if (empty($file)) {
            $this->file = file($this->getFileName());
        }

        return $this->file;
    }

    /**
     * @param array $header
     */
    private function setHeader(array $header)
    {
        $this->header = $header;
    }
}