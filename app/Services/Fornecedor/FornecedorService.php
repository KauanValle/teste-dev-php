<?php

namespace App\Services\Fornecedor;

use App\Adapters\FornecedorAdapter;
use App\Exceptions\FornecedorException;
use App\Models\Fornecedor;
use App\Repository\FornecedorRepository;
use App\Services\ApiService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class FornecedorService implements FornecedorInterface
{
    private ApiService $apiService;
    private FornecedorAdapter $adapter;
    private FornecedorRepository $repository;


    public function __construct(FornecedorRepository $repository)
    {
        $this->apiService = new ApiService();
        $this->adapter = new FornecedorAdapter();
        $this->repository = $repository;
    }

    public function consultarCnpj(string $cnpj)
    {
        return $this->apiService->fetch(config('services.brasil_api.url') . $cnpj);
    }

    /**
     * @throws FornecedorException
     */
    public function salvarDadosFornecedor(array $dados): bool
    {
        $dadosAdaptados = $this->adapter->adapt($dados);
        if($this->pegarFornecedorPorDocumentoOuFalhar($dadosAdaptados[Fornecedor::DOCUMENTO], false)){
            throw new FornecedorException("O fornecedor com o documento " . $dadosAdaptados[Fornecedor::DOCUMENTO] . " já foi registrado na nossa base de dados.", Response::HTTP_NOT_ACCEPTABLE);
        }
        return $this->repository->post($dadosAdaptados);
    }

    /**
     * @throws FornecedorException
     */
    public function atualizarDadosFornecedor(array $dados): bool
    {
        $fornecedorAntigo = $this->pegarFornecedorPorDocumentoOuFalhar($dados[Fornecedor::DOCUMENTO]);
        return $this->repository->put($fornecedorAntigo, $dados);
    }

    /**
     * @throws FornecedorException
     */
    public function deletarFornecedor(array $dados): ?bool
    {
        $fornecedorAntigo = $this->pegarFornecedorPorDocumentoOuFalhar($dados[Fornecedor::DOCUMENTO]);
        return $this->repository->delete($fornecedorAntigo);
    }

    public function listarFornecedores($filters): LengthAwarePaginator
    {
        return $this->repository->getAll($filters);
    }

    private function pegarFornecedorPorDocumentoOuFalhar($documento, $isThrow = true)
    {
        if ($fornecedor = $this->repository->getByDocumento($documento)) {
            return $fornecedor;
        }

        if ($isThrow) {
            throw new FornecedorException("Não foi possivel encontrado o fornecedor com o documento $documento na nossa base dados.", 404);
        }
        return false;
    }
}
