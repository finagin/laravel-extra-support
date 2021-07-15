<?php

namespace Finagin\ExtraSupport\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MacrosRegistrar.
 *
 * @method static \Illuminate\Support\Collection getRegisters()
 * @method static \Illuminate\Support\Collection|array additionalRegisters()
 * @method static string|null getRegister(string $macro)
 * @method static void callRegister(string $macro)
 * @method static bool tryRegisterMacro(string $macro)
 *
 * @see     \Finagin\ExtraSupport\Contracts\MacrosRegistrar
 */
class MacrosRegistrar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Finagin\ExtraSupport\Contracts\MacrosRegistrar::class;
    }
}
