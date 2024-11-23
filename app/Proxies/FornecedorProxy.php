<?php

namespace App\Proxies;

use App\Enums\FornecedorCacheEnum;
use App\Services\FornecedorService;
use Illuminate\Support\Facades\Cache;

class FornecedorProxy
{
    const CACHE_PREFIX = 'fornecedor:';
    const CACHE_TTL = 60;

    private FornecedorService $service;
    public function __construct(FornecedorService $service)
    {
        $this->service = $service;
    }

    public function consultarCnpj(string $cnpj)
    {
        $cacheKey = self::CACHE_PREFIX . FornecedorCacheEnum::DADOS_EMPRESA . $cnpj;
        if($data = Cache::get($cacheKey)){
            $data['isChached'][] = true;
            return (object)$data;
        }

        $data = $this->service->consultarCnpj($cnpj);
        Cache::put($cacheKey, $data, self::CACHE_TTL);

        return (object)$data;
    }

    public function salvarDadosFornecedor(string $cnpj)
    {
        $dadosFornecedor = $this->consultarCnpj($cnpj);
        $this->service->salvarDadosFornecedor($dadosFornecedor);
    }
}
