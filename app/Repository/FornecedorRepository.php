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
        return $this->model->save();
    }

    public function getByDocumento($documento): ?Fornecedor
    {
        return $this->model->newQuery()->where(Fornecedor::DOCUMENTO, '=', $documento)->first();
    }

    public function put(Fornecedor $fornecedorAnigo, $fornecedorNovo)
    {
        return $fornecedorAnigo->update($fornecedorNovo);
    }

    public function delete(Fornecedor $fornecedor)
    {
        return $fornecedor->delete();
    }

    public function getAll($filters, $perPage = 15)
    {
        $query = Fornecedor::query()
            ->when(!empty($filters[Fornecedor::DOCUMENTO]), function ($query) use ($filters) {
                $query->where(Fornecedor::DOCUMENTO, $filters[Fornecedor::DOCUMENTO]);
            })
            ->when(!empty($filters[Fornecedor::RAZAO_SOCIAL]), function ($query) use ($filters) {
                $query->where(Fornecedor::RAZAO_SOCIAL, 'like', '%' . $filters[Fornecedor::RAZAO_SOCIAL] . '%');
            })
            ->when(!empty($filters[Fornecedor::TELEFONE]), function ($query) use ($filters) {
                $query->where(Fornecedor::TELEFONE, 'like', '%' . $filters[Fornecedor::TELEFONE] . '%');
            })
            ->when(!empty($filters[Fornecedor::CEP]), function ($query) use ($filters) {
                $query->where(Fornecedor::CEP, $filters[Fornecedor::CEP]);
            })
            ->when(!empty($filters[Fornecedor::NATUREZA_JURIDICA]), function ($query) use ($filters) {
                $query->where(Fornecedor::NATUREZA_JURIDICA, 'like', '%' . $filters[Fornecedor::NATUREZA_JURIDICA] . '%');
            })
            ->when(!empty($filters[Fornecedor::SITUACAO_CADASTRAL]), function ($query) use ($filters) {
                $query->where(Fornecedor::SITUACAO_CADASTRAL, $filters[Fornecedor::SITUACAO_CADASTRAL]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $query;
    }
}
