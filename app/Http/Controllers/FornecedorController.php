<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
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

    public function consultarCnpj(Request $request): JsonResponse
    {
        $formattedCnpj = Formatter::formatCnpj($request->documento);
        return response()->json($this->proxy->consultarCnpj($formattedCnpj));
    }
}
