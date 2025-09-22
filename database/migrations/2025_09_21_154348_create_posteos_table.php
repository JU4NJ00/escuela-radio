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
        Schema::create('posteos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('titulo', 255);
            $table->string('slug', 255)->unique();
            $table->longText('contenido');
            $table->text('extracto')->nullable();
            $table->string('imagen_destacada')->nullable();
            $table->enum('estado', ['borrador', 'publicado', 'archivado'])->default('borrador');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->json('etiquetas')->nullable();
            $table->timestamp('fecha_publicacion')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posteos');
    }
};
