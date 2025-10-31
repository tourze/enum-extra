<?php

declare(strict_types=1);

namespace Tourze\EnumExtra;

/**
 * for EasyAdminBundle
 */
interface BadgeInterface
{
    public const SUCCESS = 'success';
    public const WARNING = 'warning';
    public const DANGER = 'danger';
    public const INFO = 'info';
    public const PRIMARY = 'primary';
    public const SECONDARY = 'secondary';
    public const LIGHT = 'light';
    public const DARK = 'dark';
    public const OUTLINE = 'outline';

    public function getBadge(): string;
}
