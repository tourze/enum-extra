<?php

namespace Tourze\EnumExtra;

trait SelectTrait
{
    public static function genOptions(): array
    {
        $arr = [];
        /** @var Itemable|\BackedEnum $case */
        foreach (static::cases() as $case) {
            // 通过配置，关闭部分选项
            $envKey = 'enum-display:' . static::class . '-' . $case->value;
            if (isset($_ENV[$envKey]) && !$_ENV[$envKey]) {
                continue;
            }

            $arr[] = $case->toSelectItem();
        }

        return $arr;
    }
}
