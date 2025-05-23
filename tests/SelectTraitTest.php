<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;

class SelectTraitTest extends TestCase
{
    private array $originalEnv;

    protected function setUp(): void
    {
        $this->originalEnv = $_ENV;
    }

    protected function tearDown(): void
    {
        $_ENV = $this->originalEnv;
    }

    public function testGenOptions(): void
    {
        $stringExpectedOptions = [
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

        $intExpectedOptions = [
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

        $this->assertEquals($stringExpectedOptions, TestStatusEnum::genOptions());
        $this->assertEquals($intExpectedOptions, BoolEnum::genOptions());
    }

    public function testOptionsFiltering(): void
    {
        // 过滤特定选项
        $_ENV['enum-display:' . TestStatusEnum::class . '-inactive'] = false;

        $filteredOptions = [
            [
                'label' => '激活',
                'text' => '激活',
                'value' => 'active',
                'name' => '激活',
            ],
            [
                'label' => '等待中',
                'text' => '等待中',
                'value' => 'pending',
                'name' => '等待中',
            ],
        ];

        $this->assertEquals($filteredOptions, TestStatusEnum::genOptions());

        // 再过滤一个选项
        $_ENV['enum-display:' . TestStatusEnum::class . '-pending'] = false;

        $moreFiltedOptions = [
            [
                'label' => '激活',
                'text' => '激活',
                'value' => 'active',
                'name' => '激活',
            ],
        ];

        $this->assertEquals($moreFiltedOptions, TestStatusEnum::genOptions());
    }
}
