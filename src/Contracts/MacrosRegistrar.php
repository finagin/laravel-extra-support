<?php

namespace Finagin\ExtraSupport\Contracts;

use Illuminate\Support\Collection;

interface MacrosRegistrar
{
    public function getRegisters(): Collection;

    /**
     * @return \Illuminate\Support\Collection|array
     */
    public function additionalRegisters();

    public function getRegister(string $macro): ?string;

    public function callRegister(string $macro): void;

    public function tryRegisterMacro(string $macro): bool;
}
