<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\BoolEnum;

class LabelableTest extends TestCase
{
    public function testEnumLabelable(): void
    {
        $this->assertEquals('激活', TestStatusEnum::ACTIVE->getLabel());
        $this->assertEquals('未激活', TestStatusEnum::INACTIVE->getLabel());
        $this->assertEquals('等待中', TestStatusEnum::PENDING->getLabel());
    }

    public function testBoolEnumLabelable(): void
    {
        $this->assertEquals('是', BoolEnum::YES->getLabel());
        $this->assertEquals('否', BoolEnum::NO->getLabel());
    }
}
