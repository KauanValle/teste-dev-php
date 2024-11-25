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
        if(Schema::hasTable(Fornecedor::TABLE)){
            Schema::table(Fornecedor::TABLE, function (Blueprint $table){
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable(Fornecedor::TABLE)){
            Schema::table(Fornecedor::TABLE, function (Blueprint $table){
                $table->dropSoftDeletes();
            });
        }
    }
};
