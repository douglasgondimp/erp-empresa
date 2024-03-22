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
        Schema::create('companies', function (Blueprint $table) {
            $table->id('recnum');
            $table->decimal('codigo', 4, 0);
            $table->decimal('empresa', 4, 0);
            $table->string('sigla', 40);
            $table->string('razao_social', 255);
            $table->timestamps();

            $table->primary(['recnum','codigo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
