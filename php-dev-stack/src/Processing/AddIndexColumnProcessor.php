<?php

namespace Sebihojda\Mbp\Processing;

use Sebihojda\Mbp\Core\DataTable;
use Sebihojda\Mbp\Core\Row;

class AddIndexColumnProcessor implements ProcessorInterface
{
    public function process(DataTable $dataTable, array $options = []): DataTable
    {
        // Adauga 'index' la antet
        $header = $dataTable->getHeader();
        if ($header) {
            $header->prepend('index');
            $dataTable->setHeader($header);
        }

        // Adauga indexul la fiecare rând
        $i = 1;
        foreach ($dataTable->getRows() as $row) {
            $row->prepend((string)$i++);
        }

        return $dataTable;
    }
}