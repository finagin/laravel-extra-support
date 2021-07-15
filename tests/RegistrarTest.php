<?php

namespace Finagin\ExtraSupport\Tests;

use Illuminate\Support\Str;

class RegistrarTest extends TestCase
{
    protected function getEnvironmentSetup($app)
    {
        $app->config->set('extra-support.registrar', \Finagin\ExtraSupport\Tests\CustomMacrosRegistrar::class);
    }

    public function testRandomAlpha()
    {
        $this->assertEquals(16, strlen(Str::randomAlpha()));
        $randomInteger = random_int(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::randomAlpha($randomInteger)));
        $this->assertIsString(Str::randomAlpha());
        $this->{$this->getRegExMethod()}('/^[0-9]{100}$/', Str::randomAlpha(100));
    }

    public function testRandomNumeric()
    {
        $this->assertEquals(16, strlen(Str::randomNumeric()));
        $randomInteger = random_int(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::randomNumeric($randomInteger)));
        $this->assertIsString(Str::randomNumeric());
        $this->{$this->getRegExMethod()}('/^[0-9]{100}$/', Str::randomNumeric(100));
    }
}
