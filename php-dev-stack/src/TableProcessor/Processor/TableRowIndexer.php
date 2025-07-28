<?php

namespace Sebihojda\Mbp\TableProcessor\Processor;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use Sebihojda\Mbp\Model\DataTable;
use Sebihojda\Mbp\Model\DataTableRow\DataRow;
use Sebihojda\Mbp\Model\DataTableRow\HeaderRow;
use Sebihojda\Mbp\TableProcessor\Config\OutputFormatConfig;
use Sebihojda\Mbp\TableProcessor\ConfigurableInterface;
use Sebihojda\Mbp\TableProcessor\TableProcessorConfigInterface;
use Sebihojda\Mbp\TableProcessor\TableProcessorInterface;

class TableRowIndexer implements TableProcessorInterface, ConfigurableInterface
{
    private OutputFormatConfig $config;


    public function process(DataTable ...$tables): array
    {
        $results = [];
        foreach ($tables as $table) {
            $headers = $table->getHeaderRow()->prependHeaderColumn('index');
            $result = DataTable::createEmpty($headers);
            /** @var DataRow|HeaderRow $row */
            foreach ($table as $i => $row) {
                if($i != 0) {
                    $arrRow = $row->toArray();
                    array_unshift($arrRow, $i);
                    $result->appendRow(DataRow::fromArray($arrRow, $result));//I've tried $row->put('index', $i) or $row->prependElement('index', $i) but without success
                }
            }
            $results[] = $result;
        }

        return $results;
    }

    public function configure(TableProcessorConfigInterface $config): static
    {
        if (!$config instanceof OutputFormatConfig) {
            throw new InvalidArgumentException('Invalid config type');
        }
        $this->config = $config;

        return $this;
    }
}