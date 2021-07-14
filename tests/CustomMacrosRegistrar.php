<?php

namespace Finagin\ExtraSupport\Tests;

use Finagin\ExtraSupport\Services\MacrosRegistrar;
use Illuminate\Support\Str;

class CustomMacrosRegistrar extends MacrosRegistrar
{
    /**
     * @return \Illuminate\Support\Collection|array
     */
    public function additionalRegisters()
    {
        return [
            '\\Illuminate\\Support\\Str@randomAlpha' => 'registerMacroRandomBadAlpha',
            '\\Illuminate\\Support\\Str@randomNumeric' => 'registerMacroRandomNumeric',
        ];
    }

    protected function registerMacroRandomBadAlpha()
    {
        Str::macro('randomAlpha', static function ($length = 16) {
            return Str::randomWithExclude($length, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
        });
    }

    protected function registerMacroRandomNumeric()
    {
        Str::macro('randomNumeric', static function ($length = 16) {
            return Str::randomWithExclude($length, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
        });
    }
}
