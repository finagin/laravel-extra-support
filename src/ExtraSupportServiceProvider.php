<?php

namespace Finagin\ExtraSupport;

use Finagin\ExtraSupport\Contracts\MacrosRegistrar as MacrosRegistrarInterface;
use Finagin\ExtraSupport\Facades\MacrosRegistrar as MacrosRegistrarFacade;
use Finagin\ExtraSupport\Services\MacrosRegistrar;
use Illuminate\Support\ServiceProvider;

class ExtraSupportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMacros();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();

        $this->app->singleton(MacrosRegistrarInterface::class, function () {
            $macrosRegistrarClass = config('extra-support.registrar', MacrosRegistrar::class);
            $macrosRegistrarInstance = new $macrosRegistrarClass;

            if (! $macrosRegistrarInstance instanceof MacrosRegistrar) {
                throw new \RuntimeException();
            }

            return $macrosRegistrarInstance;
        });
    }

    /**
     * Setup the configuration for Horizon.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/extra-support.php', 'extra-support'
        );
    }

    protected function registerMacros()
    {
        MacrosRegistrarFacade::getRegisters()
            ->each(function ($registerMethod, $macro) {
                MacrosRegistrarFacade::tryRegisterMacro($macro);
            });
    }
}
