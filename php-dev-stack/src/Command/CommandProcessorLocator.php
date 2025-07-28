<?php

declare(strict_types=1);

namespace Sebihojda\Mbp\Command;

use Sebihojda\Mbp\TableProcessor\Processor\ColumnSignatureVerifier;
use Sebihojda\Mbp\TableProcessor\Processor\ColumnSigner;
use Sebihojda\Mbp\TableProcessor\Processor\TableHeaderPrepender;
use Sebihojda\Mbp\TableProcessor\Processor\TableMerger;
use Sebihojda\Mbp\TableProcessor\Processor\TableRowIndexer;
use Sebihojda\Mbp\TableProcessor\TableProcessorInterface;
use Ds\Map;

class CommandProcessorLocator
{
    private const array COMMANDS_TO_CLASSES = [
        'csv-column-sign'        => ColumnSigner::class,
        'csv-column-sign-verify' => ColumnSignatureVerifier::class,
        'csv-headers-prepend'    => TableHeaderPrepender::class,
        'csv-merge'              => TableMerger::class,
        'csv-row-indexer'        => TableRowIndexer::class,
    ];

    private Map $processors;

    public function __construct()
    {
        $this->processors = new Map();
    }

    public function getProcessorByTool(string $tool): TableProcessorInterface
    {
        if ($this->processors->hasKey($tool)) {
            return $this->processors[$tool];
        }
        $class = self::COMMANDS_TO_CLASSES[$tool];
        $this->processors[$tool] = new $class();

        return $this->processors[$tool];
    }
}
