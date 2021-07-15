<?php

return [

    'registrar' => \Finagin\ExtraSupport\Services\MacrosRegistrar::class,

    'dependencies' => [

        '\\Illuminate\\Support\\Str@randomAlpha' => [
            '\\Illuminate\\Support\\Str@randomWithExclude',
        ],

    ],

    'disabled' => [
        // '\\Illuminate\\Support\\Str@randomWithExclude',
    ],

];
