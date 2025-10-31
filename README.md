# PHP Enum Extra

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![License](https://img.shields.io/packagist/l/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)

A PHP package that enhances PHP 8.1+ enums with additional functionality, providing commonly used enum extensions for easier data handling and UI integration.

## Features

- Convert enum cases to select options with custom labels
- Environment-based option filtering with `enum-display:{enum}-{value}`
- Array conversion utilities for easy data transformation
- Interface support for flexible implementation
- Type-safe enum operations
- Boolean enum implementation with useful helpers
- Tree data structure support for hierarchical data
- Data fetcher interfaces for standardized data retrieval
- Badge interface for EasyAdminBundle integration

## Requirements

- PHP 8.1 or higher

## Installation

```bash
composer require tourze/enum-extra
```

## Quick Start

```php
use Tourze\EnumExtra\Itemable;
use Tourze\EnumExtra\ItemTrait;
use Tourze\EnumExtra\Labelable;
use Tourze\EnumExtra\Selectable;
use Tourze\EnumExtra\SelectTrait;

enum Status: string implements Labelable, Itemable, Selectable
{
    use ItemTrait;
    use SelectTrait;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function getLabel(): string
    {
        return match($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }
}

// Generate select options
$options = Status::genOptions();
// Result: [['label' => 'Active', 'text' => 'Active', 'value' => 'active', 'name' => 'Active'], ...]

// Convert single case to array
$array = Status::ACTIVE->toArray();
// Result: ['value' => 'active', 'label' => 'Active']
```

## Available Interfaces

### Labelable

This interface provides a way to add human-readable labels to enum cases.

```php
interface Labelable
{
    public function getLabel(): string;
}
```

### Itemable

This interface allows converting enum cases to select option items.

```php
interface Itemable
{
    public function toSelectItem(): array;
}
```

### Selectable

This interface provides methods to generate select options from enum cases.

```php
interface Selectable
{
    public static function genOptions(): array;
}
```

### SelectDataFetcher

This interface standardizes data fetching for select components.

```php
interface SelectDataFetcher
{
    public function genSelectData(): iterable;
}
```

### TreeDataFetcher

This interface provides methods to generate hierarchical tree data.

```php
interface TreeDataFetcher
{
    public function genTreeData(): array;
}
```

### BadgeInterface

This interface provides badge constants for EasyAdminBundle integration.

```php
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
```

## Features in Detail

### Select Options Generation

Convert enum cases to select options format for UI components:

```php
$options = Status::genOptions();
```

You can filter options using environment variables:

```php
// In your .env file or server configuration
$_ENV['enum-display:App\\Enums\\Status-inactive'] = false;

// Now Status::genOptions() will exclude the INACTIVE option
```

### BoolEnum

A ready-to-use boolean enum implementation:

```php
use Tourze\EnumExtra\BoolEnum;

$value = BoolEnum::YES;
$boolValue = $value->toBool(); // true

// Generate boolean options
$options = BoolEnum::genBoolOptions();
// Result: [['label' => '是', 'text' => '是', 'value' => true, 'name' => '是'], ...]
```

### Array Conversion

Convert enum cases to array format for easy serialization:

```php
$array = Status::ACTIVE->toArray();
// Result: ['value' => 'active', 'label' => 'Active']
```

### Badge Integration

Use badge interface for EasyAdminBundle styling:

```php
use Tourze\EnumExtra\BadgeInterface;

enum UserStatus: string implements BadgeInterface, Labelable
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case BANNED = 'banned';

    public function getLabel(): string
    {
        return match($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::BANNED => 'Banned',
        };
    }

    public function getBadge(): string
    {
        return match($this) {
            self::ACTIVE => self::SUCCESS,
            self::INACTIVE => self::WARNING,
            self::BANNED => self::DANGER,
        };
    }
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
