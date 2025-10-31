<?php

declare(strict_types=1);

namespace Tourze\EnumExtra;

trait ItemTrait
{
    /**
     * @return array<string, mixed>
     */
    public function toSelectItem(): array
    {
        return [
            'label' => $this->getLabel(),
            'text' => $this->getLabel(),
            'value' => $this->value,
            'name' => $this->getLabel(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    final public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => $this->getLabel(),
        ];
    }
}
