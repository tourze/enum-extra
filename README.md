# PHP Enum Extra

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![License](https://img.shields.io/packagist/l/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)

A PHP package that enhances PHP 8.1+ enums with additional functionality, providing commonly used enum extensions.

## Features

- Convert enum cases to select options with custom labels
- Environment-based option filtering with `enum-display:{enum}-{value}`
- Array conversion utilities for easy data transformation
- Interface support for flexible implementation
- Type-safe enum operations

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

// Convert single case to array
$array = Status::ACTIVE->toArray();
```

## Available Interfaces

- `Labelable`: For implementing custom labels
- `Itemable`: For select item conversion
- `Selectable`: For options generation

## Features in Detail

### Select Options Generation

- Convert enum cases to select options format
- Support for custom labels
- Environment-based filtering using `enum-display:{enum}-{value}`

### Array Conversion

- Convert enum cases to array format
- Includes both value and label

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
