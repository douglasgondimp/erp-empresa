<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('recnum');
            $table->decimal('empresa', 4, 0);
            $table->decimal('codigo', 4, 0);
            $table->string('razao_social', 255);
            $table->enum('tipo', ['PF', 'PJ']);
            $table->string('cpf_cnpj', 14);
            $table->timestamps();

            $table->primary(['recnum', 'codigo']);
            $table->index(['codigo','empresa']);
            $table->foreign('empresa')->references('codigo')->on('companies');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('recnum')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
        });

        Schema::dropIfExists('clients');
    }
};
