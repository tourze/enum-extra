<?php

declare(strict_types=1);

namespace Tourze\EnumExtra;

interface Selectable
{
    /**
     * 获取枚举生成的选项列表
     * @return array<int, array<string, mixed>>
     */
    public static function genOptions(): array;
}
