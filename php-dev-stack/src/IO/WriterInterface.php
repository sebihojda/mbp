<?php

namespace Sebihojda\Mbp\IO;

use Sebihojda\Mbp\Core\DataTable;

interface WriterInterface {
    /** @param resource $stream */
    public function write($stream, DataTable $dataTable): void;
}