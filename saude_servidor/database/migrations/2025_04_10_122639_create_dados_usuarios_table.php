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
        Schema::create('dados_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('endereco');
            $table->integer('idade');
            $table->float('altura');
            $table->date('data_registro');
            $table->float('peso');
            $table->float('imc');
            $table->float('circunferencia_abdominal');
            $table->boolean('diabetico');
            $table->boolean('pressao_alta');
            $table->boolean('dores_articulacoes');
            $table->boolean('atividade_fisica');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados_usuarios');
    }
};
