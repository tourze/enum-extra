<?php

namespace Tourze\EnumExtra;

enum BoolEnum: int implements Labelable, Itemable, Selectable
{
    use ItemTrait;
    use SelectTrait;

    case YES = 1;
    case NO = 0;

    public function getLabel(): string
    {
        return match ($this) {
            self::YES => '是',
            self::NO => '否',
        };
    }

    public function toBool(): bool
    {
        return $this->value === 1;
    }

    /**
     * 生成布尔值选项列表
     */
    public static function genBoolOptions(): array
    {
        $arr = [];
        /** @var Itemable|\BackedEnum $case */
        foreach (self::cases() as $case) {
            $arr[] = [
                ...$case->toSelectItem(),
                'value' => $case->toBool(),
            ];
        }

        return $arr;
    }
}
