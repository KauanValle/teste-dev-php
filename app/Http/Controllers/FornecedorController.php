<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\Http\Requests\FornecedorRequest;
use App\Proxies\FornecedorProxy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    private FornecedorProxy $proxy;
    public function __construct(FornecedorProxy $proxy)
    {
        $this->proxy = $proxy;;
    }

    public function consultarCnpj(FornecedorRequest $request): JsonResponse
    {
        $formattedCnpj = Formatter::formatCnpj($request->documento);
        $dadosEmpresa = $this->proxy->consultarCnpj($formattedCnpj);

        return response()->json($dadosEmpresa);
    }

    public function salvarFornecedor(FornecedorRequest $request)
    {
        $formattedCnpj = Formatter::formatCnpj($request->documento);
        $this->proxy->salvarDadosFornecedor($formattedCnpj);

        return response()->json(['message' => 'Fornecedor salvo com sucesso!']);
    }
}
