<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class FornecedorException extends ExceptionAbstract
{
    protected $message;
    protected $statusCode;

    public function __construct($message = 'Erro desconhecido', $statusCode = 400)
    {
        parent::__construct($message, $statusCode);
    }

    /**
     * Personalizar a resposta da exceção com formato JSON
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request): JsonResponse
    {
        return parent::render($request);
    }
}
