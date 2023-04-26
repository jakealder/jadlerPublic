<?php

namespace app\Api\Contracts;
interface Api
{
    /**
     * Get the users from the API
     *
     * @return mixed
     */
    public function getUsers(int $page, int $perPage) : array;
}
