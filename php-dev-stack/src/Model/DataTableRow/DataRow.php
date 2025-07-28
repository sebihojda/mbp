<?php

declare(strict_types=1);

namespace Sebihojda\Mbp\Model\DataTableRow;

use Sebihojda\Mbp\Model\DataTable;
use Sebihojda\Mbp\Model\DataTableRow;
use Ds\Map;
use Webmozart\Assert\Assert;

/**
 * Models a data table data row.
 */
class DataRow extends DataTableRow
{
    private function __construct(
        private readonly Map $row,
    ) {
        //
    }

    public static function fromArray(array $rowValues, DataTable $table): static
    {
        $headerRow = $table->getHeaderRow();
        Assert::eq(count($rowValues), $headerRow->count());

        $rowData = new Map();
        foreach (array_values($rowValues) as $i => $columnValue) {
            $rowData[$headerRow[$i]] = $columnValue;
        }

        return new static($rowData);
    }

    public function toArray(): array
    {
        return $this->row->values()->toArray();
    }

    public function prependElement(string $header, string $value): static
    {
        $this->row->put($header, $value);
        return new static($this->row);
    }
}
