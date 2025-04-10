<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('dados_saude', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('endereco');
        $table->integer('idade');
        $table->decimal('altura', 5, 2);
        $table->decimal('peso', 5, 2);
        $table->decimal('imc', 5, 2)->nullable(); // será calculado automaticamente
        $table->integer('circunferencia_abdominal')->nullable();
        $table->boolean('diabetico')->default(false);
        $table->boolean('pressao_alta')->default(false);
        $table->boolean('dores_articulacoes')->default(false);
        $table->boolean('atividade_fisica')->default(false);
        $table->date('data_registro');
        $table->timestamps();
        $table->softDeletes(); // para manter no histórico mesmo que excluído
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados_saude');
    }
};
