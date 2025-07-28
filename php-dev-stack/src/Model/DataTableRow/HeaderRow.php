<?php

declare(strict_types=1);

namespace Sebihojda\Mbp\Model\DataTableRow;

use ArrayAccess;
use Countable;
use Ds\Vector;

/**
 * Models a data table headers row.
 */
readonly class HeaderRow implements Countable, ArrayAccess
{
    private function __construct(
        private Vector $row,
        private bool $isDefault = false,
    ) {
        //
    }

    public static function fromDefaults(int $columnCount): static
    {
        $defaultHeaders = range(1, $columnCount);
        $row = new Vector(array_map(static fn($value) => (string)$value, $defaultHeaders));

        return new static($row, true);
    }

    public static function fromVector(Vector $row): static
    {
        return new static($row);
    }

    public function copy(): static
    {
        return new static($this->row->copy(), $this->isDefault);
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->row->offsetExists($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->row->offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->row->offsetSet($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->row->offsetUnset($offset);
    }

    public function count(): int
    {
        return $this->row->count();
    }

    public function toArray(): array
    {
        return $this->row->toArray();
    }

    public function prependHeaderColumn(string $headerRowValue): static
    {
        $this->row->unshift($headerRowValue);
        return new static($this->row);
    }
}
