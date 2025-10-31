<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use Tourze\EnumExtra\Itemable;
use Tourze\EnumExtra\ItemTrait;
use Tourze\EnumExtra\Labelable;
use Tourze\EnumExtra\Selectable;
use Tourze\EnumExtra\SelectTrait;

enum TestStatusEnum: string implements Labelable, Itemable, Selectable
{
    use ItemTrait;
    use SelectTrait;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => '激活',
            self::INACTIVE => '未激活',
            self::PENDING => '等待中',
        };
    }
}
