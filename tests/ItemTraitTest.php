<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;
use Tourze\EnumExtra\ItemTrait;

/**
 * @internal
 */
#[CoversClass(ItemTrait::class)]
final class ItemTraitTest extends TestCase
{
    public function testToArray(): void
    {
        // 测试 string 枚举
        $expectedStringArray = [
            'value' => 'active',
            'label' => '激活',
        ];
        $this->assertSame($expectedStringArray, TestStatusEnum::ACTIVE->toArray());

        // 测试 int 枚举
        $expectedIntArray = [
            'value' => 1,
            'label' => '是',
        ];
        $this->assertSame($expectedIntArray, BoolEnum::YES->toArray());
    }

    public function testToArrayConsistency(): void
    {
        // 确保 toArray 方法返回的数据与实际值一致
        foreach (TestStatusEnum::cases() as $case) {
            $array = $case->toArray();
            $this->assertSame($case->value, $array['value']);
            $this->assertSame($case->getLabel(), $array['label']);
        }

        foreach (BoolEnum::cases() as $case) {
            $array = $case->toArray();
            $this->assertSame($case->value, $array['value']);
            $this->assertSame($case->getLabel(), $array['label']);
        }
    }
}
