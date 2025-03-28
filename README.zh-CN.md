# PHP Enum Extra

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)
[![License](https://img.shields.io/packagist/l/tourze/enum-extra.svg?style=flat-square)](https://packagist.org/packages/tourze/enum-extra)

一个增强 PHP 8.1+ 枚举功能的扩展包，提供了一系列实用的枚举工具和功能。

## 特性

- 支持将枚举转换为下拉选项并自定义标签
- 通过 `enum-display:{enum}-{value}` 进行环境变量过滤
- 提供数组转换工具，便于数据转换
- 灵活的接口支持
- 类型安全的枚举操作

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

## 可用接口

- `Labelable`: 用于实现自定义标签
- `Itemable`: 用于下拉选项转换
- `Selectable`: 用于选项生成

## 功能详解

### 下拉选项生成

- 将枚举转换为下拉选项格式
- 支持自定义标签
- 使用 `enum-display:{enum}-{value}` 进行环境变量过滤

### 数组转换

- 将枚举转换为数组格式
- 包含值和标签信息

## 贡献

详情请参见 [CONTRIBUTING](CONTRIBUTING.md)。

## 开源协议

本项目采用 MIT 协议。详情请参见 [License File](LICENSE)。
