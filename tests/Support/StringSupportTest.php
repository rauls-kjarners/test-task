<?php

namespace App\Tests\Support;

use App\Support\StringSupport;
use PHPUnit\Framework\TestCase;

class StringSupportTest extends TestCase
{
    /**
     * @dataProvider getSubstringsProvider
     *
     * @param string $input
     * @param int    $minLength
     * @param array  $expected
     */
    public function testGetSubstrings(string $input, int $minLength, array $expected)
    {
        $this->assertEquals($expected, (new StringSupport())->getSubstrings($input, $minLength));
    }

    /**
     * @return array
     */
    public function getSubstringsProvider(): array
    {
        return [
            [
                'ABCDEF', 2, ['EF','CD','AB']
            ],
            [
                'qwertyuiolk', 3, ['olk','yui','qwert']
            ],
            [
                'qwertyuiolk', 5, ['uiolk','qwerty']
            ],
            [
                'abcde', 1, ['e','d','c','b','a']
            ],
            [
                'abcde', 10, ['abcde']
            ],
            [
                'abcde', 2, ['de', 'abc']
            ],
            [
                'abc', 3, ['abc']
            ],
            [
                'abc', 2, ['abc']
            ],
            [
                '', 5, []
            ],
            [
                'ABC', 0, []
            ],
            [
                'A', -1, []
            ]
        ];
    }
}
