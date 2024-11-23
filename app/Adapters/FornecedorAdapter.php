<?php

namespace App\Adapters;

class FornecedorAdapter implements AdapterInterface
{
    public function adapt($dados)
    {
        return [
            "documento" => $dados->cnpj,
            "razao_social" => $dados->razao_social,
            "telefone" => $dados->ddd_telefone_1,
            "cep" => $dados->cep,
            "natureza_juridica" => $dados->natureza_juridica,
            "situacao_cadastral" => $dados->descricao_situacao_cadastral
        ];
    }
}
