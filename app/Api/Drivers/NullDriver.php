<?php

namespace App\Api\Drivers;

use App\Api\Contracts\Api;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NullDriver implements Api {

    public function __construct()
    {

    }

    public function getUsers(int $page = 1, int $perPage = 6): array {
        return [];
    }




}
