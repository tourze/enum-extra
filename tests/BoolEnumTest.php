<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;

class BoolEnumTest extends TestCase
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
}
