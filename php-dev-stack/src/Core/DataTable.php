<?php

namespace Sebihojda\Mbp\Core;

class DataTable
{
    /** @var Row[] */
    private array $rows = [];
    private ?Row $header = null;

    public function addRow(Row $row): void
    {
        $this->rows[] = $row;
    }

    /** @return Row[] */
    public function getRows(): array
    {
        return $this->rows;
    }

    public function setHeader(Row $header): void
    {
        $this->header = $header;
    }

    public function getHeader(): ?Row
    {
        return $this->header;
    }

    public function prependRow(Row $row): void
    {
        array_unshift($this->rows, $row);
    }
}