# Laravel Extra Support

[![StyleCI][ico-styleci]][link-styleci]
[![GitHub Actions][ico-github-actions]][link-github-actions]
[![GitHub Issues][ico-github-issues]][link-github-issues]
[![Total Downloads][ico-packagist-downloads]][link-packagist-downloads]
[![Latest Stable Version][ico-packagist-version]][link-packagist-downloads]
[![Software License][ico-license]][link-license]


<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->

- [Installation](#installation)
- [Usage](#usage)
  - [Str::randomWithExclude()](#strrandomwithexclude)
  - [Str::randomAlpha()](#strrandomalpha)
- [Customization](#customization)
- [License](#license)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Installation

```shell
composer require finagin/laravel-extra-support
```

## Usage

### Str::randomWithExclude() 

Returns random string with excludes.

```php
use Illuminate\Support\Str;

Str::randomWithExclude();
Str::randomWithExclude(15);
Str::randomWithExclude(16, ['a', 'b', 'c']);
Str::randomWithExclude(16, 'abc');
```

### Str::randomAlpha() 

Returns random string without numeric.

```php
use Illuminate\Support\Str;

Str::randomAlpha();
Str::randomAlpha(15);
```

## Customization

```php
<?php

namespace App\Services;

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
            '\\Illuminate\\Support\\Str@randomExcludeSimilar' => 'registerMacroRandomExcludeSimilar',
        ];
    }

    protected function registerMacroRandomExcludeSimilar()
    {
        Str::macro('randomExcludeSimilar', static function ($length = 16) {
            return Str::randomWithExclude($length, ['1', 'l', '0', 'O']);
        });
    }
}
```

In config replace `registrar` with new registrar class:

```php
<?php

return [

    'registrar' => \App\Services\CustomMacrosRegistrar::class,
    
    // ...
];
```

Finally, add dependencies to the appropriate section if you need them:

```php
<?php

return [
    // ...
    'dependencies' => [
        // ...
        '\\Illuminate\\Support\\Str@randomExcludeSimilar' => [
            '\\Illuminate\\Support\\Str@randomWithExclude',
        ],
        // ...
    ],
    // ...
];
```

## License

The MIT License ([MIT](https://opensource.org/licenses/MIT)). Please see [License File][link-license] for more information.


<!-- Icons -->

[ico-license]: https://img.shields.io/packagist/l/finagin/laravel-extra-support
[link-license]: https://github.com/finagin/laravel-extra-support/blob/master/LICENSE.md

[ico-styleci]: https://styleci.io/repos/386349632/shield?branch=develop&style=flat
[link-styleci]: https://styleci.io/repos/386349632

[ico-github-actions]: https://github.com/finagin/laravel-extra-support/workflows/Tests/badge.svg?branch=master
[link-github-actions]: https://github.com/finagin/laravel-extra-support/actions

[ico-github-issues]: https://img.shields.io/github/issues/finagin/laravel-extra-support
[link-github-issues]: https://github.com/finagin/laravel-extra-support/issues

[ico-packagist-downloads]: https://img.shields.io/packagist/dt/finagin/laravel-extra-support
[ico-packagist-version]: https://img.shields.io/packagist/v/finagin/laravel-extra-support
[link-packagist-downloads]: https://packagist.org/packages/finagin/laravel-extra-support
