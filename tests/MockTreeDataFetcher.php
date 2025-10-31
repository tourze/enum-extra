<?php

declare(strict_types=1);

namespace Tourze\EnumExtra\Tests;

use Tourze\EnumExtra\TreeDataFetcher;

class MockTreeDataFetcher implements TreeDataFetcher
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function genTreeData(): array
    {
        return [
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
    }
}
