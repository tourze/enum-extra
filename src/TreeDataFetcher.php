<?php

declare(strict_types=1);

namespace Tourze\EnumExtra;

/**
 * 树数据获取工具
 */
interface TreeDataFetcher
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function genTreeData(): array;
}
