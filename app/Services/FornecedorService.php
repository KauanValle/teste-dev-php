<?php

namespace App\Services;

use App\Adapters\FornecedorAdapter;
use App\Models\Fornecedor;
use App\Repository\FornecedorRepository;
use Illuminate\Support\Facades\Cache;

class FornecedorService
{
    private ApiService $apiService;
    private FornecedorRepository $repository;
    private FornecedorAdapter $adapter;

    public function __construct(FornecedorRepository $repository)
    {
        $this->apiService = new ApiService();
        $this->adapter = new FornecedorAdapter();
        $this->repository = $repository;
    }

    public function consultarCnpj(string $cnpj)
    {
        return $this->apiService->fetch("https://brasilapi.com.br/api/cnpj/v1/" . $cnpj);
    }

    public function salvarDadosFornecedor($dadosFornecedor)
    {
        $dadosAdaptados = $this->adapter->adapt($dadosFornecedor);
        if(!$this->pegarFornecedorPorDocumento($dadosAdaptados['documento'])){
            $this->repository->post($dadosAdaptados);
        }
    }

    public function pegarFornecedorPorDocumento($documento)
    {
        return $this->repository->getByDocumento($documento);
    }
}
