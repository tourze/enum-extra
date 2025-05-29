<?php

namespace Tourze\EnumExtra;

/**
 * for EasyAdminBundle
 */
interface BadgeInterface
{
    const SUCCESS = 'success';
    const WARNING = 'warning';
    const DANGER = 'danger';
    const INFO = 'info';
    const PRIMARY = 'primary';
    const SECONDARY = 'secondary';
    const LIGHT = 'light';
    const DARK = 'dark';
    const OUTLINE = 'outline';

    public function getBadge(): string;
}
