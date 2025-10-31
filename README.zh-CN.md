# PHP Enum Extra

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![License](https://img.shields.io/packagist/l/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)

一个增强 PHP 8.1+ 枚举功能的扩展包，提供了一系列实用的枚举工具和功能，便于数据处理和 UI 集成。

## 特性

- 支持将枚举转换为下拉选项并自定义标签
- 通过 `enum-display:{enum}-{value}` 进行环境变量过滤
- 提供数组转换工具，便于数据转换
- 灵活的接口支持
- 类型安全的枚举操作
- 内置布尔枚举实现及辅助方法
- 提供树结构数据支持，便于处理层级数据
- 标准化数据获取接口
- Badge 接口，便于与 EasyAdminBundle 集成

## 环境要求

- PHP 8.1 或更高版本

## 安装

```bash
composer require tourze/enum-extra
```

## 快速开始

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
            self::ACTIVE => '激活',
            self::INACTIVE => '未激活',
        };
    }
}

// 生成下拉选项
$options = Status::genOptions();
// 结果: [['label' => '激活', 'text' => '激活', 'value' => 'active', 'name' => '激活'], ...]

// 转换单个枚举为数组
$array = Status::ACTIVE->toArray();
// 结果: ['value' => 'active', 'label' => '激活']
```

## 可用接口

### Labelable

此接口提供了为枚举添加人类可读标签的方法。

```php
interface Labelable
{
    public function getLabel(): string;
}
```

### Itemable

此接口允许将枚举转换为下拉选项项目。

```php
interface Itemable
{
    public function toSelectItem(): array;
}
```

### Selectable

此接口提供了从枚举生成下拉选项的方法。

```php
interface Selectable
{
    public static function genOptions(): array;
}
```

### SelectDataFetcher

此接口标准化了下拉组件的数据获取。

```php
interface SelectDataFetcher
{
    public function genSelectData(): iterable;
}
```

### TreeDataFetcher

此接口提供了生成层级树形数据的方法。

```php
interface TreeDataFetcher
{
    public function genTreeData(): array;
}
```

### BadgeInterface

此接口提供了与 EasyAdminBundle 集成的徽章常量。

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

## 功能详解

### 下拉选项生成

将枚举转换为 UI 组件可用的下拉选项格式：

```php
$options = Status::genOptions();
```

您可以使用环境变量过滤选项：

```php
// 在 .env 文件或服务器配置中
$_ENV['enum-display:App\\Enums\\Status-inactive'] = false;

// 此时 Status::genOptions() 将排除 INACTIVE 选项
```

### BoolEnum

一个开箱即用的布尔枚举实现：

```php
use Tourze\EnumExtra\BoolEnum;

$value = BoolEnum::YES;
$boolValue = $value->toBool(); // true

// 生成布尔选项
$options = BoolEnum::genBoolOptions();
// 结果: [['label' => '是', 'text' => '是', 'value' => true, 'name' => '是'], ...]
```

### 数组转换

将枚举转换为数组格式，便于序列化：

```php
$array = Status::ACTIVE->toArray();
// 结果: ['value' => 'active', 'label' => '激活']
```

### Badge 集成

使用 Badge 接口进行 EasyAdminBundle 样式集成：

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
            self::ACTIVE => '激活',
            self::INACTIVE => '未激活',
            self::BANNED => '已封禁',
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

## 贡献

详情请参见 [CONTRIBUTING](CONTRIBUTING.md)。

## 开源协议

本项目采用 MIT 协议。详情请参见 [License File](LICENSE)。
