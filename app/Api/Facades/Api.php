<?php

namespace App\Api\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getUsers()
 * @method static channel(string $string)
 */
class Api extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string {
        return 'api';
    }
}
