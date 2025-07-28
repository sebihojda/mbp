<?php

namespace Sebihojda\Mbp\IO;

use Sebihojda\Mbp\Core\DataTable;
use Sebihojda\Mbp\Core\Row;

class CsvReader implements ReaderInterface
{
    public function read($stream): DataTable
    {
        $dataTable = new DataTable();
        $isHeader = true;

        while (($data = fgetcsv($stream)) !== false) {
            if ($isHeader) {
                $dataTable->setHeader(new Row($data));
                $isHeader = false;
                continue;
            }
            $dataTable->addRow(new Row($data));
        }
        return $dataTable;
    }
}