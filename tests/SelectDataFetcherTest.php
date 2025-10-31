<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\EnumExtra\SelectDataFetcher;

/**
 * @internal
 */
#[CoversClass(SelectDataFetcher::class)]
final class SelectDataFetcherTest extends TestCase
{
    public function testGenSelectData(): void
    {
        $fetcher = new MockSelectDataFetcher();
        $data = iterator_to_array($fetcher->genSelectData());

        $expectedData = [
            [
                'label' => '选项1',
                'text' => '选项1',
                'value' => 'option1',
                'name' => '选项1',
            ],
            [
                'label' => '选项2',
                'text' => '选项2',
                'value' => 'option2',
                'name' => '选项2',
            ],
        ];

        $this->assertEquals($expectedData, $data);
    }
}
