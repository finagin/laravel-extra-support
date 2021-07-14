<?php

namespace Finagin\ExtraSupport\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use RuntimeException;

abstract class AbstractMacrosRegistrar
{
    /**
     * @return \Illuminate\Support\Collection|array
     */
    abstract public function getRegisters(): Collection;

    /**
     * @return \Illuminate\Support\Collection|array
     */
    public function additionalRegisters()
    {
        return [];
    }

    public function getRegister(string $macro): ?string
    {
        return $this->getRegisters()
            ->get($macro);
    }

    public function callRegister(string $macro): void
    {
        $method = $this->getRegister($macro);

        if ($method === null) {
            throw new RuntimeException();
        }

        $this->{$method}();
    }

    public function tryRegisterMacro(string $macro): bool
    {
        [$class, $method] = Str::parseCallback($macro);

        if (! class_exists($class)) {
            return false;
        }

        if (in_array($macro, config('extra-support.disabled'))) {
            return false;
        }

        foreach (config('extra-support.dependencies.'.$macro, []) as $dependency) {
            if (! $this->tryRegisterMacro($dependency)) {
                return false;
            }
        }

        if (! method_exists($class, $method)) {
            if (! method_exists($class, 'hasMacro') || ! method_exists($class, 'macro')) {
                return false;
            }

            if (! $class::hasMacro($method)) {
                try {
                    $this->callRegister($macro);
                } catch (\RuntimeException $e) {
                    return false;
                }
            }
        }

        return method_exists($class, $method)
            || (
                method_exists($class, 'hasMacro')
                && $class::hasMacro($method)
            );
    }
}
