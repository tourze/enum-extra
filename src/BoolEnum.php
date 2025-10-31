<?php

declare(strict_types=1);

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
        return 1 === $this->value;
    }

    public function getStatus(): string
    {
        return match ($this) {
            self::YES => 'success',
            self::NO => 'error',
        };
    }

    /**
     * @return array<string, mixed>
     */
    public function toSelectItem(): array
    {
        return [
            'label' => $this->getLabel(),
            'text' => $this->getLabel(),
            'value' => $this->value,
            'name' => $this->getLabel(),
            'status' => $this->getStatus(),
        ];
    }

    /**
     * 生成布尔值选项列表
     * @return array<int, array<string, mixed>>
     */
    public static function genBoolOptions(): array
    {
        $arr = [];
        foreach (self::cases() as $case) {
            $arr[] = [
                ...$case->toSelectItem(),
                'value' => $case->toBool(),
            ];
        }

        return $arr;
    }
}
