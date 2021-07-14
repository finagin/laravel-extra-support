<?php

namespace Finagin\ExtraSupport\Tests;

use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as BaseTestCase;
use PHPUnit\Runner\Version;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->beforeApplicationDestroyed(function () {
            Str::macro('clearMacros', static function () {
                static::$macros = [];
            });

            Str::clearMacros();
        });

        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Finagin\ExtraSupport\ExtraSupportServiceProvider::class,
        ];
    }

    protected function getRegExMethod(): string
    {
        return version_compare(Version::id(), '9.1.0', '>=')
            ? 'assertMatchesRegularExpression'
            : 'assertRegExp';
    }
}
