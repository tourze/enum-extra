<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\EnumExtra\BoolEnum;
use Tourze\PHPUnitEnum\AbstractEnumTestCase;

/**
 * @internal
 */
#[CoversClass(BoolEnum::class)]
final class BoolEnumTest extends AbstractEnumTestCase
{
    public function testToBool(): void
    {
        $this->assertTrue(BoolEnum::YES->toBool());
        $this->assertFalse(BoolEnum::NO->toBool());
    }

    public function testBoolTypeCasting(): void
    {
        $this->assertSame(true, BoolEnum::YES->toBool());
        $this->assertSame(false, BoolEnum::NO->toBool());
    }

    public function testBoolEnumCases(): void
    {
        $this->assertSame(1, BoolEnum::YES->value);
        $this->assertSame(0, BoolEnum::NO->value);
    }

    public function testToArray(): void
    {
        $yesArray = BoolEnum::YES->toArray();
        $this->assertSame(['value' => 1, 'label' => '是'], $yesArray);

        $noArray = BoolEnum::NO->toArray();
        $this->assertSame(['value' => 0, 'label' => '否'], $noArray);
    }

    public function testGetStatus(): void
    {
        $this->assertSame('success', BoolEnum::YES->getStatus());
        $this->assertSame('error', BoolEnum::NO->getStatus());
    }

    public function testFromInvalidValueThrowsException(): void
    {
        $this->expectException(\ValueError::class);
        BoolEnum::from(999);
    }

    public function testTryFromInvalidValueReturnsNull(): void
    {
        // 测试业务需要验证非法枚举值的处理行为
        $invalid = $this->getInvalidEnumValue();
        $result = BoolEnum::tryFrom($invalid);
        $this->assertNull($result);
    }

    /**
     * 获取无效的枚举值用于测试
     * 通过私有方法返回，破坏PHPStan的编译期类型推断
     */
    private function getInvalidEnumValue(): int
    {
        return 999;
    }

    public function testToSelectItemIncludesStatus(): void
    {
        $item = BoolEnum::YES->toSelectItem();
        $this->assertArrayHasKey('status', $item);
        $this->assertSame('success', $item['status']);

        $item = BoolEnum::NO->toSelectItem();
        $this->assertArrayHasKey('status', $item);
        $this->assertSame('error', $item['status']);
    }

    public function testGenBoolOptions(): void
    {
        $options = BoolEnum::genBoolOptions();
        $this->assertCount(2, $options);

        // 验证第一个选项 (YES)
        $this->assertArrayHasKey('label', $options[0]);
        $this->assertArrayHasKey('text', $options[0]);
        $this->assertArrayHasKey('value', $options[0]);
        $this->assertArrayHasKey('name', $options[0]);
        $this->assertArrayHasKey('status', $options[0]);
        $this->assertSame(true, $options[0]['value']);
        $this->assertSame('success', $options[0]['status']);

        // 验证第二个选项 (NO)
        $this->assertArrayHasKey('label', $options[1]);
        $this->assertArrayHasKey('text', $options[1]);
        $this->assertArrayHasKey('value', $options[1]);
        $this->assertArrayHasKey('name', $options[1]);
        $this->assertArrayHasKey('status', $options[1]);
        $this->assertSame(false, $options[1]['value']);
        $this->assertSame('error', $options[1]['status']);
    }
}
