<?php

namespace Tourze\EnumExtra;

interface Selectable
{
    /**
     * 获取枚举生成的选项列表
     */
    public static function genOptions(): array;
}
