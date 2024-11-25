<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ExceptionAbstract extends Exception
{
    protected $message;
    protected $statusCode;

    public function __construct($message = 'Erro desconhecido', $statusCode = 400)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    public function render($request): JsonResponse
    {
        // Retorna a resposta JSON com a mensagem de erro e código de status
        return response()->json([
            'error' => [
                'message' => $this->message,
                'status_code' => $this->statusCode
            ]
        ], $this->statusCode);
    }
}
