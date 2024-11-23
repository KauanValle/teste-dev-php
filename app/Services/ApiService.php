<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public function fetch($endpoint)
    {
        $response = Http::get($endpoint);
        if($response->successful()){
            return $response->json();
        }
        return null;
    }
}
