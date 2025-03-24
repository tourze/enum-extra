# PHP Enum Extra

PHP 枚举增强包，提供了一些常用的枚举扩展功能。

[English](#english) | [中文](#中文)

## English

A PHP package that enhances PHP 8.1+ enums with additional functionality.

### Features

- Convert enum cases to select options
- Support for custom labels
- Environment-based option filtering
- Array conversion utilities

### Installation

```bash
composer require tourze/enum-extra
```

### Usage

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

### Features in Detail

1. **Select Options Generation**
   - Convert enum cases to select options format
   - Support for custom labels
   - Environment-based filtering using `enum-display:{enum}-{value}`

2. **Array Conversion**
   - Convert enum cases to array format
   - Includes both value and label

3. **Interface Support**
   - `Labelable`: For custom label implementation
   - `Itemable`: For select item conversion
   - `Selectable`: For options generation

## 中文

一个增强 PHP 8.1+ 枚举功能的包。

### 特性

- 将枚举转换为下拉选项
- 支持自定义标签
- 基于环境变量的选项过滤
- 数组转换工具

### 安装

```bash
composer require tourze/enum-extra
```

### 使用示例

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

// 生成下拉选项
$options = Status::genOptions();

// 转换单个枚举为数组
$array = Status::ACTIVE->toArray();
```

### 详细特性

1. **下拉选项生成**
   - 将枚举转换为下拉选项格式
   - 支持自定义标签
   - 使用 `enum-display:{enum}-{value}` 进行环境变量过滤

2. **数组转换**
   - 将枚举转换为数组格式
   - 包含值和标签

3. **接口支持**
   - `Labelable`: 用于自定义标签实现
   - `Itemable`: 用于下拉选项转换
   - `Selectable`: 用于选项生成
