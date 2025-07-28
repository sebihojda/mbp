<?php

namespace Sebihojda\Mbp\Processing;

use Sebihojda\Mbp\Core\DataTable;
use Sebihojda\Mbp\Core\Row;


class PrependHeaderProcessor implements ProcessorInterface
{
    public function process(DataTable $dataTable, array $options = []): DataTable
    {
        // $options['headers'] va contine array-ul cu numele coloanelor
        if (isset($options['headers'])) {
            $dataTable->setHeader(new Row($options['headers']));
        }
        return $dataTable;
    }
}