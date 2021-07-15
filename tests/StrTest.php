<?php

namespace Finagin\ExtraSupport\Tests;

use Illuminate\Support\Str;

class StrTest extends TestCase
{
    /**
     * @dataProvider excludedRandomChars
     */
    public function testRandomWithExcludedChars($excludeChars)
    {
        $forPattern = is_array($excludeChars)
            ? implode('', $excludeChars)
            : $excludeChars;

        $this->{$this->getRegExMethod()}(
            '/^[^'.$forPattern.']{100}$/',
            Str::randomWithExclude(100, $excludeChars)
        );
    }

    public function testRandomAlpha()
    {
        $this->assertEquals(16, strlen(Str::randomAlpha()));
        $randomInteger = random_int(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::randomAlpha($randomInteger)));
        $this->assertIsString(Str::randomAlpha());
        $this->{$this->getRegExMethod()}('/^[^0-9]{100}$/', Str::randomAlpha(100));
    }

    public function excludedRandomChars()
    {
        $chars = array_map(
            function ($item) {
                return chr($item);
            },
            array_merge(
                range(ord('0'), ord('9')),
                range(ord('A'), ord('Z')),
                range(ord('a'), ord('z'))
            )
        );

        shuffle($chars);

        return [
            [array_splice($chars, 0, 10)],
            [array_splice($chars, 0, 10)],
            [array_splice($chars, 0, 10)],
            [array_splice($chars, 0, 10)],
            [array_splice($chars, 0, 10)],
            [array_splice($chars, 0, 10)],
            ['abcdefjhijklmnopqrstuvwxyz'],
            ['0123456789'],
        ];
    }
}
