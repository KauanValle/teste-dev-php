<?php

namespace App\Proxies;

use App\Enums\FornecedorCacheEnum;
use App\Services\FornecedorService;
use Illuminate\Support\Facades\Cache;

class FornecedorProxy
{
    private FornecedorService $service;
    public function __construct(FornecedorService $service)
    {
        $this->service = $service;
    }

    public function consultarCnpj(string $cnpj)
    {
        $cacheKey = FornecedorCacheEnum::DADOS_EMPRESA . $cnpj;
        if($data = Cache::get($cacheKey)){
            $data['isChached'][] = true;
            return $data;
        }

        $data = $this->service->consultarCnpj($cnpj);
        Cache::put($cacheKey, $data, 60);

        return $data;
    }

}
