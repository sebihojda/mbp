<?php

namespace Sebihojda\Mbp\IO;

use Sebihojda\Mbp\Core\DataTable;


class CsvWriter implements WriterInterface
{
    public function write($stream, DataTable $dataTable): void
    {
        if ($header = $dataTable->getHeader()) {
            fputcsv($stream, $header->toArray());
        }

        foreach ($dataTable->getRows() as $row) {
            fputcsv($stream, $row->toArray());
        }
    }
}