<?php

namespace app\Api\Contracts;
interface Api
{
    /**
     * Send the given message to the given recipient.
     *
     * @return mixed
     */
    public function getUsers(int $page, int $perPage) : mixed;
}
