<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class FornecedorService
{
    private ApiService $apiService;
    public function __construct()
    {
        $this->apiService = new ApiService();
    }

    public function consultarCnpj(string $cnpj)
    {
        $data = $this->apiService->fetch("https://brasilapi.com.br/api/cnpj/v1/" . $cnpj);
        Cache::put('dados_empresa', $data, 60);
        return $data;
    }
}
