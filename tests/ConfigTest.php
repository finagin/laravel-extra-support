<?php

namespace Finagin\ExtraSupport\Tests;

use Illuminate\Support\Str;

class ConfigTest extends TestCase
{
    protected function getEnvironmentSetup($app)
    {
        $app->config->set('extra-support.disabled', [
            '\\Illuminate\\Support\\Str@randomWithExclude',
        ]);
    }

    public function testDisabledMacros()
    {
        $this->assertFalse(Str::hasMacro('randomWithExclude'));
        $this->assertFalse(Str::hasMacro('randomAlpha'));
    }
}
