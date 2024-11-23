<?php

use App\Models\Fornecedor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Fornecedor::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Fornecedor::DOCUMENTO);
            $table->string(Fornecedor::RAZAO_SOCIAL);
            $table->string(Fornecedor::TELEFONE);
            $table->string(Fornecedor::CEP);
            $table->string(Fornecedor::NATUREZA_JURIDICA);
            $table->string(Fornecedor::SITUACAO_CADASTRAL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_fornecedores');
    }
};
