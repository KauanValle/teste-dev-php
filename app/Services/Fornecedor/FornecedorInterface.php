<?php

namespace App\Services\Fornecedor;

interface FornecedorInterface
{
    public function consultarCnpj(string $cnpj);
    public function salvarDadosFornecedor(array $dados);
    public function atualizarDadosFornecedor(array $dados);
    public function deletarFornecedor(array $dados);
    public function listarFornecedores($filters);
}
