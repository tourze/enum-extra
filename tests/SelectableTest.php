<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;

class SelectableTest extends TestCase
{
    public function testGenOptions(): void
    {
        $expectedOptions = [
            [
                'label' => '激活',
                'text' => '激活',
                'value' => 'active',
                'name' => '激活',
            ],
            [
                'label' => '未激活',
                'text' => '未激活',
                'value' => 'inactive',
                'name' => '未激活',
            ],
            [
                'label' => '等待中',
                'text' => '等待中',
                'value' => 'pending',
                'name' => '等待中',
            ],
        ];

        $this->assertEquals($expectedOptions, TestStatusEnum::genOptions());
    }

    public function testBoolEnumGenOptions(): void
    {
        $expectedOptions = [
            [
                'label' => '是',
                'text' => '是',
                'value' => 1,
                'name' => '是',
                'status' => 'success',
            ],
            [
                'label' => '否',
                'text' => '否',
                'value' => 0,
                'name' => '否',
                'status' => 'error',
            ],
        ];

        $this->assertEquals($expectedOptions, BoolEnum::genOptions());
    }

    public function testBoolEnumGenBoolOptions(): void
    {
        $expectedOptions = [
            [
                'label' => '是',
                'text' => '是',
                'value' => true,
                'name' => '是',
                'status' => 'success',
            ],
            [
                'label' => '否',
                'text' => '否',
                'value' => false,
                'name' => '否',
                'status' => 'error',
            ],
        ];

        $this->assertEquals($expectedOptions, BoolEnum::genBoolOptions());
    }
}
