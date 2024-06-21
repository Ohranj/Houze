<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\CustomAuthProvider;

return [
    AppServiceProvider::class,
    CustomAuthProvider::class
];
