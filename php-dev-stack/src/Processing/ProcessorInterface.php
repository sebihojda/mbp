<?php

namespace Sebihojda\Mbp\Processing;

use Sebihojda\Mbp\Core\DataTable;

interface ProcessorInterface
{
    public function process(DataTable $dataTable, array $options = []): DataTable;
}