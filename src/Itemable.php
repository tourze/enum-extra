<?php

namespace Tourze\EnumExtra;

interface Itemable
{
    /**
     * 生成枚举下拉选项
     */
    public function toSelectItem(): array;
}
