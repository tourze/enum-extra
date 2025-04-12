<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;

class ItemableTest extends TestCase
{
    public function testToSelectItem(): void
    {
        $expectedItem = [
            'label' => '激活',
            'text' => '激活',
            'value' => 'active',
            'name' => '激活',
        ];

        $this->assertEquals($expectedItem, TestStatusEnum::ACTIVE->toSelectItem());
    }

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
        ];

        $this->assertEquals($expectedItem, BoolEnum::YES->toSelectItem());

        $expectedArray = [
            'value' => 1,
            'label' => '是',
        ];

        $this->assertEquals($expectedArray, BoolEnum::YES->toArray());
    }
}
