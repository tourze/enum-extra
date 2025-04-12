<?php

namespace Tourze\EnumExtra\Tests;

use Tourze\EnumExtra\SelectDataFetcher;

class MockSelectDataFetcher implements SelectDataFetcher
{
    public function genSelectData(): iterable
    {
        yield [
            'label' => '选项1',
            'text' => '选项1',
            'value' => 'option1',
            'name' => '选项1',
        ];

        yield [
            'label' => '选项2',
            'text' => '选项2',
            'value' => 'option2',
            'name' => '选项2',
        ];
    }
}
