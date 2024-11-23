<?php

namespace App\Repository;

use App\Models\Fornecedor;

class FornecedorRepository
{
    private Fornecedor $model;
    public function __construct()
    {
        $this->model = new Fornecedor();
    }

    public function post($data)
    {
        $this->model->fill($data);
        $this->model->save();
    }

    public function getByDocumento($documento)
    {
        return $this->model->newQuery()->where(Fornecedor::DOCUMENTO, '=', $documento)->first();
    }
}
