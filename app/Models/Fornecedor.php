<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    const TABLE = 'fornecedores';

    const DOCUMENTO = 'documento';
    const RAZAO_SOCIAL = "razao_social";
    const TELEFONE = 'telefone';
    const CEP = 'cep';
    const NATUREZA_JURIDICA = 'natureza_juridica';
    const SITUACAO_CADASTRAL = 'situacao_cadastral';

    protected $table = self::TABLE;
    protected $fillable = [
        self::DOCUMENTO,
        self::RAZAO_SOCIAL,
        self::TELEFONE,
        self::CEP,
        self::NATUREZA_JURIDICA,
        self::SITUACAO_CADASTRAL
    ];
}
