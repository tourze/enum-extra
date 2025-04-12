<?php

namespace Tourze\EnumExtra;

/**
 * 下拉数据生成
 */
interface SelectDataFetcher
{
    /**
     * 生成下拉数据
     *
     * @return iterable<array{label: string, text: string, value: string, name: string}>
     */
    public function genSelectData(): iterable;
}
