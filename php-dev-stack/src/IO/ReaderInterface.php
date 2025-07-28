<?php

namespace Sebihojda\Mbp\IO;

use Sebihojda\Mbp\Core\DataTable;

interface ReaderInterface {
    /** @param resource $stream */
    public function read($stream): DataTable;
}
