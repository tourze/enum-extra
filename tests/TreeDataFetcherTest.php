<?php

namespace Tourze\EnumExtra\Tests;

use PHPUnit\Framework\TestCase;

class TreeDataFetcherTest extends TestCase
{
    public function testGenTreeData(): void
    {
        $fetcher = new MockTreeDataFetcher();
        $data = $fetcher->genTreeData();

        $expectedData = [
            [
                'label' => '父级1',
                'value' => 'parent1',
                'children' => [
                    [
                        'label' => '子级1',
                        'value' => 'child1',
                    ],
                    [
                        'label' => '子级2',
                        'value' => 'child2',
                    ],
                ],
            ],
            [
                'label' => '父级2',
                'value' => 'parent2',
                'children' => [],
            ],
        ];

        $this->assertEquals($expectedData, $data);
    }
}
