<?php

declare(strict_types=1);

namespace Tourze\EnumExtra;

interface Itemable
{
    /**
     * 生成枚举下拉选项
     * @return array<string, mixed>
     */
    public function toSelectItem(): array;
}
