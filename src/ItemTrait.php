<?php

namespace Tourze\EnumExtra;

trait ItemTrait
{
    public function toSelectItem(): array
    {
        return [
            'label' => $this->getLabel(),
            'text' => $this->getLabel(),
            'value' => $this->value,
            'name' => $this->getLabel(),
        ];
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => $this->getLabel(),
        ];
    }
}
