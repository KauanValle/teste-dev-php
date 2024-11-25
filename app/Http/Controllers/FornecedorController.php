<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedor;
use App\Services\Fornecedor\FornecedorInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FornecedorController extends Controller
{
    private $service;
    public function __construct(FornecedorInterface $service)
    {
        $this->service = $service;;
    }

    public function salvarFornecedor(FornecedorRequest $request): JsonResponse
    {
        $this->service->salvarDadosFornecedor($request->all());
        return response()->json(['message' => 'Fornecedor salvo com sucesso!'], Response::HTTP_CREATED);
    }

    public function atualizarFornecedor(FornecedorRequest $request): JsonResponse
    {
        $this->service->atualizarDadosFornecedor($request->all());
        return response()->json(['message' => 'Fornecedor atualizado com sucesso!'], Response::HTTP_OK);
    }

    public function deletarFornecedor(FornecedorRequest $request): JsonResponse
    {
        $this->service->deletarFornecedor($request->all());
        return response()->json(['message' => 'Fornecedor deletado com sucesso!'], Response::HTTP_OK);
    }

    public function listarFornecedores(FornecedorRequest $request): JsonResponse
    {
        $filters = $request->only([Fornecedor::DOCUMENTO, Fornecedor::RAZAO_SOCIAL, Fornecedor::TELEFONE, Fornecedor::CEP, Fornecedor::NATUREZA_JURIDICA, Fornecedor::SITUACAO_CADASTRAL]);
        $listaFornecedores = $this->service->listarFornecedores($filters);
        return response()->json(['message' => $listaFornecedores], Response::HTTP_OK);
    }
}
