<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\SelectTrait;

/**
 * @internal
 */
#[CoversClass(SelectTrait::class)]
final class EnvironmentFilterTest extends TestCase
{
    /** @var array<string, mixed> */
    private array $originalEnv;

    protected function setUp(): void
    {
        parent::setUp();
        /** @var array<string, mixed> $_ENV */
        $this->originalEnv = $_ENV;
    }

    protected function tearDown(): void
    {
        $_ENV = $this->originalEnv;
    }

    public function testEnvFilterOption(): void
    {
        // 设置环境变量过滤 INACTIVE 选项
        $_ENV['enum-display:' . TestStatusEnum::class . '-inactive'] = false;

        $expectedOptions = [
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

        $this->assertEquals($expectedOptions, TestStatusEnum::genOptions());
    }

    public function testEnvFilterMultipleOptions(): void
    {
        // 设置环境变量过滤多个选项
        $_ENV['enum-display:' . TestStatusEnum::class . '-inactive'] = false;
        $_ENV['enum-display:' . TestStatusEnum::class . '-pending'] = false;

        $expectedOptions = [
            [
                'label' => '激活',
                'text' => '激活',
                'value' => 'active',
                'name' => '激活',
            ],
        ];

        $this->assertEquals($expectedOptions, TestStatusEnum::genOptions());
    }

    public function testEnvFilterAllOptions(): void
    {
        // 设置环境变量过滤所有选项
        $_ENV['enum-display:' . TestStatusEnum::class . '-active'] = false;
        $_ENV['enum-display:' . TestStatusEnum::class . '-inactive'] = false;
        $_ENV['enum-display:' . TestStatusEnum::class . '-pending'] = false;

        $this->assertEquals([], TestStatusEnum::genOptions());
    }

    public function testEnvFilterNonExistentOptions(): void
    {
        // 设置不存在的环境变量不应该影响结果
        $_ENV['enum-display:' . TestStatusEnum::class . '-nonexistent'] = false;

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
}
