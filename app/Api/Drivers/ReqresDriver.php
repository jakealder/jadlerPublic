<?php

namespace App\Api\Drivers;

use App\Api\Contracts\Api;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReqresDriver implements Api
{

    /**
     * @param int $page
     * @param int $perPage
     * @return array|string[]
     */
    public function getUsers(int $page = 1, int $perPage = 6): array {

        $response = Http::withOptions(['verify' => false])->withUrlParameters([
            'endpoint' => 'https://reqres.in/api/users',
            'page' => $page,
            'per_page' => $perPage
        ])->get('{+endpoint}?page={page}&per_page={per_page}');

        //Send responses
        if ($response->successful()) {
            return [
                'status' => 'success',
                'message' => $response->json()
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Error connecting to API, check log file for details.'
        ];
    }
}
