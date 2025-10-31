<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;
use Tourze\EnumExtra\Itemable;

/**
 * @internal
 */
#[CoversClass(Itemable::class)]
final class ItemableTest extends TestCase
{
    public function testToArray(): void
    {
        $expectedArray = [
            'value' => 'active',
            'label' => '激活',
        ];

        $this->assertEquals($expectedArray, TestStatusEnum::ACTIVE->toArray());
    }

    public function testBoolEnumItemable(): void
    {
        $expectedItem = [
            'label' => '是',
            'text' => '是',
            'value' => 1,
            'name' => '是',
            'status' => 'success',
        ];

        $this->assertEquals($expectedItem, BoolEnum::YES->toSelectItem());

        $expectedArray = [
            'value' => 1,
            'label' => '是',
        ];

        $this->assertEquals($expectedArray, BoolEnum::YES->toArray());
    }
}
