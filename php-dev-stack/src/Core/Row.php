<?php

namespace Sebihojda\Mbp\Core;

class Row
{
    public function __construct(private array $data = []) {}

    public function get(int $index): ?string
    {
        return $this->data[$index] ?? null;
    }

    public function set(int $index, string $value): void
    {
        $this->data[$index] = $value;
    }

    public function prepend(string $value): void
    {
        array_unshift($this->data, $value);
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
