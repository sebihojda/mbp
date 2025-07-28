#!/usr/bin/env php
<?php

require_once __DIR__.'/../vendor/autoload.php';

// --- Setup ---
use Sebihojda\Mbp\IO\CsvReader;
use Sebihojda\Mbp\IO\CsvWriter;
use Sebihojda\Mbp\Processing\AddIndexColumnProcessor;

$reader = new CsvReader();
$writer = new CsvWriter();
$processor = new AddIndexColumnProcessor();

$inStream = fopen('php://stdin', 'rb');
$outStream = fopen('php://stdout', 'wb');

// --- Execuție ---
// 1. Citește datele și le transformă într-o structură internă (DataTable)
$dataTable = $reader->read($inStream);

// 2. Aplică procesorul pentru a modifica structura de date
$processedTable = $processor->process($dataTable);

// 3. Scrie structura modificată înapoi în formatul dorit (CSV)
$writer->write($outStream, $processedTable);

// --- Cleanup ---
fclose($inStream);
fclose($outStream);
