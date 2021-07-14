<?php

namespace Finagin\ExtraSupport\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class MacrosRegistrar extends AbstractMacrosRegistrar
{
    /**
     * @return \Illuminate\Support\Collection|array
     */
    public function getRegisters(): Collection
    {
        return collect([
            '\\Illuminate\\Support\\Str@randomAlpha' => 'registerMacroRandomAlpha',
            '\\Illuminate\\Support\\Str@randomWithExclude' => 'registerMacroRandomWithExclude',
        ])->merge($this->additionalRegisters());
    }

    protected function registerMacroRandomWithExclude()
    {
        Str::macro('randomWithExclude', static function ($length = 16, $excludeChars = []) {
            $string = '';

            $excludeChars = array_merge(
                ['/', '+', '='],
                is_string($excludeChars)
                    ? str_split($excludeChars)
                    : $excludeChars
            );

            while (($len = strlen($string)) < $length) {
                $size = $length - $len;

                $bytes = random_bytes($size);

                $string .= substr(str_replace($excludeChars, '', base64_encode($bytes)), 0, $size);
            }

            return $string;
        });
    }

    protected function registerMacroRandomAlpha()
    {
        Str::macro('randomAlpha', static function ($length = 16) {
            return Str::randomWithExclude($length, range(0, 9));
        });
    }
}
