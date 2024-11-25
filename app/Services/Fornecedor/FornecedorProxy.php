<?php

namespace App\Services\Fornecedor;

use App\Enums\FornecedorCacheEnum;
use App\Exceptions\FornecedorException;
use App\Helpers\Formatter;
use App\Models\Fornecedor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class FornecedorProxy implements FornecedorInterface
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
        $cacheKey = self::CACHE_PREFIX . FornecedorCacheEnum::DADOS_FORNECEDOR . $cnpj;
        if($data = Cache::get($cacheKey)){
            return $data;
        }

        $data = $this->service->consultarCnpj($cnpj);
        Cache::put($cacheKey, $data, self::CACHE_TTL);

        return $data;
    }

    /**
     * @throws FornecedorException
     */
    public function salvarDadosFornecedor(array $dados): void
    {
        $dados[Fornecedor::DOCUMENTO] = Formatter::formatCnpj($dados[Fornecedor::DOCUMENTO]);
        $dadosFornecedor = $this->consultarCnpj($dados[Fornecedor::DOCUMENTO]);
        if(is_null($dadosFornecedor)){
            throw new FornecedorException("Não foi encontrado as informações desse CNPJ.", Response::HTTP_NOT_FOUND);
        }

        $this->service->salvarDadosFornecedor($dadosFornecedor);
    }

    /**
     * @throws FornecedorException
     */
    public function atualizarDadosFornecedor(array $dados): void
    {
        $this->service->atualizarDadosFornecedor($dados);
    }

    /**
     * @throws FornecedorException
     */
    public function deletarFornecedor(array $dados): void
    {
        $this->service->deletarFornecedor($dados);
    }

    public function listarFornecedores($filters): LengthAwarePaginator
    {
        return $this->service->listarFornecedores($filters);
    }
}
