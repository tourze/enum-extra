<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;

class ItemTraitTest extends TestCase
{
    public function testToSelectItem(): void
    {
        // 测试 string 枚举
        $expectedStringItem = [
            'label' => '激活',
            'text' => '激活',
            'value' => 'active',
            'name' => '激活',
        ];
        $this->assertEquals($expectedStringItem, TestStatusEnum::ACTIVE->toSelectItem());

        // 测试 int 枚举
        $expectedIntItem = [
            'label' => '是',
            'text' => '是',
            'value' => 1,
            'name' => '是',
        ];
        $this->assertEquals($expectedIntItem, BoolEnum::YES->toSelectItem());
    }

    public function testToArray(): void
    {
        // 测试 string 枚举
        $expectedStringArray = [
            'value' => 'active',
            'label' => '激活',
        ];
        $this->assertEquals($expectedStringArray, TestStatusEnum::ACTIVE->toArray());

        // 测试 int 枚举
        $expectedIntArray = [
            'value' => 1,
            'label' => '是',
        ];
        $this->assertEquals($expectedIntArray, BoolEnum::YES->toArray());
    }

    public function testToArrayConsistency(): void
    {
        // 确保 toArray 方法返回的数据与实际值一致
        foreach (TestStatusEnum::cases() as $case) {
            $array = $case->toArray();
            $this->assertEquals($case->value, $array['value']);
            $this->assertEquals($case->getLabel(), $array['label']);
        }

        foreach (BoolEnum::cases() as $case) {
            $array = $case->toArray();
            $this->assertEquals($case->value, $array['value']);
            $this->assertEquals($case->getLabel(), $array['label']);
        }
    }
}
