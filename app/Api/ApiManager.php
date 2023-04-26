<?php

namespace App\Api;

use app\Api\Drivers\ReqresDriver;
use Illuminate\Support\Manager;

class ApiManager extends Manager {

    /**
     * Get a driver instance.
     *
     * @param  string|null  $name
     * @return mixed
     */
    public function channel($name = null)
    {
        return $this->driver($name);
    }

    /**
     * Create a Reqres driver instance.
     *
     * @return \App\Api\Drivers\ReqresDriver;
     */
    public function createReqresDriver()
    {
        return new ReqresDriver(
            $this->createReqresDriver()
        );
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['api.default'] ?? 'null';
    }


}
