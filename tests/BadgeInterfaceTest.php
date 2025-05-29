<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Tourze\EnumExtra\BadgeInterface;

class BadgeInterfaceTest extends TestCase
{
    public function test_constants_have_correct_values(): void
    {
        $this->assertSame('success', BadgeInterface::SUCCESS);
        $this->assertSame('warning', BadgeInterface::WARNING);
        $this->assertSame('danger', BadgeInterface::DANGER);
        $this->assertSame('info', BadgeInterface::INFO);
        $this->assertSame('primary', BadgeInterface::PRIMARY);
        $this->assertSame('secondary', BadgeInterface::SECONDARY);
        $this->assertSame('light', BadgeInterface::LIGHT);
        $this->assertSame('dark', BadgeInterface::DARK);
        $this->assertSame('outline', BadgeInterface::OUTLINE);
    }

    public function test_interface_has_all_expected_constants(): void
    {
        $reflection = new ReflectionClass(BadgeInterface::class);
        $constants = $reflection->getConstants();

        $expectedConstants = [
            'SUCCESS' => 'success',
            'WARNING' => 'warning', 
            'DANGER' => 'danger',
            'INFO' => 'info',
            'PRIMARY' => 'primary',
            'SECONDARY' => 'secondary',
            'LIGHT' => 'light',
            'DARK' => 'dark',
            'OUTLINE' => 'outline'
        ];

        $this->assertSame($expectedConstants, $constants);
        $this->assertCount(9, $constants);
    }

    public function test_constants_are_all_strings(): void
    {
        $reflection = new ReflectionClass(BadgeInterface::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $constant) {
            $this->assertIsString($constant);
        }
    }

    public function test_constants_are_unique_values(): void
    {
        $reflection = new ReflectionClass(BadgeInterface::class);
        $constants = array_values($reflection->getConstants());
        $uniqueConstants = array_unique($constants);

        $this->assertSame($constants, $uniqueConstants, 'All constants should have unique values');
    }

    public function test_interface_implementation_contract(): void
    {
        $implementation = new class implements BadgeInterface {
            public function getBadge(): string 
            {
                return self::SUCCESS;
            }
        };

        $this->assertInstanceOf(BadgeInterface::class, $implementation);
        $this->assertSame('success', $implementation->getBadge());
    }

    public function test_implementation_can_return_all_badge_types(): void
    {
        $reflection = new ReflectionClass(BadgeInterface::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $constantName => $constantValue) {
            $implementation = new class($constantValue) implements BadgeInterface {
                public function __construct(
                    private readonly string $badge
                ) {}

                public function getBadge(): string 
                {
                    return $this->badge;
                }
            };

            $this->assertSame($constantValue, $implementation->getBadge(), 
                "Implementation should be able to return {$constantName} ({$constantValue})");
        }
    }

    public function test_implementation_with_empty_string(): void
    {
        $implementation = new class implements BadgeInterface {
            public function getBadge(): string 
            {
                return '';
            }
        };

        $this->assertSame('', $implementation->getBadge());
    }

    public function test_implementation_with_custom_badge(): void
    {
        $customBadge = 'custom-badge-type';
        
        $implementation = new class($customBadge) implements BadgeInterface {
            public function __construct(
                private readonly string $badge
            ) {}

            public function getBadge(): string 
            {
                return $this->badge;
            }
        };

        $this->assertSame($customBadge, $implementation->getBadge());
    }

    public function test_constants_follow_naming_convention(): void
    {
        $reflection = new ReflectionClass(BadgeInterface::class);
        $constantNames = array_keys($reflection->getConstants());

        foreach ($constantNames as $constantName) {
            // 常量名应该全大写，用下划线分隔
            $this->assertMatchesRegularExpression('/^[A-Z_]+$/', $constantName, 
                "Constant {$constantName} should follow UPPER_CASE naming convention");
        }
    }

    public function test_constant_values_are_valid_css_classes(): void
    {
        $reflection = new ReflectionClass(BadgeInterface::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $constantName => $constantValue) {
            // CSS 类名应该只包含字母、数字、连字符
            $this->assertMatchesRegularExpression('/^[a-zA-Z0-9-]+$/', $constantValue,
                "Constant {$constantName} value '{$constantValue}' should be a valid CSS class name");
            
            // 不应该包含空格
            $this->assertStringNotContainsString(' ', $constantValue,
                "Constant {$constantName} value should not contain spaces");
        }
    }
} 