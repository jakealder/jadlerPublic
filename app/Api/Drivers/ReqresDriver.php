<?php

namespace app\Api\Drivers;

use app\Api\Contracts\Api;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReqresDriver implements Api {

    public function __construct()
    {

    }

    public function getUsers(int $page = 1, int $perPage = 6): mixed {
        try {
            return Http::get('https://reqres.in/api/users', [
                'page' => $page,
                'per_page' => $perPage
            ]);
        } catch (\Exception $exception) {
            Log::Error(print_r($exception, true));
            abort(500);
        }
    }




}
