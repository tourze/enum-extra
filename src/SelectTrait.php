<?php

declare(strict_types=1);

namespace Tourze\EnumExtra;

trait SelectTrait
{
    /**
     * @return array<int, array<string, mixed>>
     */
    final public static function genOptions(): array
    {
        $arr = [];
        foreach (static::cases() as $case) {
            // 通过配置，关闭部分选项
            $envKey = 'enum-display:' . get_class($case) . '-' . $case->value;
            if (isset($_ENV[$envKey]) && !((bool) $_ENV[$envKey])) {
                continue;
            }

            $arr[] = $case->toSelectItem();
        }

        return $arr;
    }
}
