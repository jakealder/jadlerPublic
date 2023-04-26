<?php

namespace App\Api;

use App\Api\Drivers\ReqresDriver;
use App\Api\Drivers\NullDriver;
use Illuminate\Support\Manager;

class ApiManager extends Manager {

    /**
     * Get a driver instance.
     *
     * @param string|null $name
     * @return mixed
     */
    public function channel(string $name = null): mixed {
        return $this->driver($name);
    }

    /**
     * Create a Reqres driver instance.
     *
     * @return ReqresDriver;
     */
    public function createReqresDriver(): ReqresDriver {
        return new ReqresDriver();
    }

    /**
     * Create a null driver instance.
     *
     * @return NullDriver;
     */
    public function createNullDriver(): NullDriver {
        return new NullDriver();
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver(): string {
        return config('api.default') ?? 'null';
    }


}
