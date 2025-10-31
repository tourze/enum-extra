<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BadgeInterface;

/**
 * @internal
 */
#[CoversClass(BadgeInterface::class)]
final class BadgeInterfaceTest extends TestCase
{
    public function testConstantsHaveCorrectValues(): void
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

    public function testInterfaceHasAllExpectedConstants(): void
    {
        $reflection = new \ReflectionClass(BadgeInterface::class);
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
            'OUTLINE' => 'outline',
        ];

        $this->assertSame($expectedConstants, $constants);
        $this->assertCount(9, $constants);
    }

    public function testConstantsAreAllStrings(): void
    {
        $reflection = new \ReflectionClass(BadgeInterface::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $constant) {
            $this->assertIsString($constant);
        }
    }

    public function testConstantsAreUniqueValues(): void
    {
        $reflection = new \ReflectionClass(BadgeInterface::class);
        $constants = array_values($reflection->getConstants());
        $uniqueConstants = array_unique($constants);

        $this->assertSame($constants, $uniqueConstants, 'All constants should have unique values');
    }

    public function testInterfaceImplementationContract(): void
    {
        $implementation = new class () implements BadgeInterface {
            public function getBadge(): string
            {
                return self::SUCCESS;
            }
        };

        $this->assertInstanceOf(BadgeInterface::class, $implementation);
        $this->assertSame('success', $implementation->getBadge());
    }

    public function testImplementationCanReturnAllBadgeTypes(): void
    {
        $reflection = new \ReflectionClass(BadgeInterface::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $constantName => $constantValue) {
            $this->assertIsString($constantValue, "Badge constant {$constantName} must be a string");
            $implementation = new class ($constantValue) implements BadgeInterface {
                public function __construct(
                    private readonly string $badge,
                ) {
                }

                public function getBadge(): string
                {
                    return $this->badge;
                }
            };

            $this->assertSame(
                $constantValue,
                $implementation->getBadge(),
                "Implementation should be able to return {$constantName} ({$constantValue})"
            );
        }
    }

    public function testImplementationWithEmptyString(): void
    {
        $implementation = new class () implements BadgeInterface {
            public function getBadge(): string
            {
                return '';
            }
        };

        $this->assertSame('', $implementation->getBadge());
    }

    public function testImplementationWithCustomBadge(): void
    {
        $customBadge = 'custom-badge-type';

        $implementation = new class ($customBadge) implements BadgeInterface {
            public function __construct(
                private readonly string $badge,
            ) {
            }

            public function getBadge(): string
            {
                return $this->badge;
            }
        };

        $this->assertSame($customBadge, $implementation->getBadge());
    }

    public function testConstantsFollowNamingConvention(): void
    {
        $reflection = new \ReflectionClass(BadgeInterface::class);
        $constantNames = array_keys($reflection->getConstants());

        foreach ($constantNames as $constantName) {
            // 常量名应该全大写，用下划线分隔
            $this->assertMatchesRegularExpression(
                '/^[A-Z_]+$/',
                $constantName,
                "Constant {$constantName} should follow UPPER_CASE naming convention"
            );
        }
    }

    public function testConstantValuesAreValidCssClasses(): void
    {
        $reflection = new \ReflectionClass(BadgeInterface::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $constantName => $constantValue) {
            $this->assertIsString($constantValue, "Badge constant {$constantName} must be a string");

            // CSS 类名应该只包含字母、数字、连字符
            $this->assertMatchesRegularExpression(
                '/^[a-zA-Z0-9-]+$/',
                $constantValue,
                "Constant {$constantName} value '{$constantValue}' should be a valid CSS class name"
            );

            // 不应该包含空格
            $this->assertStringNotContainsString(
                ' ',
                $constantValue,
                "Constant {$constantName} value should not contain spaces"
            );
        }
    }
}
