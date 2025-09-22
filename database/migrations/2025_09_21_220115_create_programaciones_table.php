<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programa_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('dia_semana'); // 0=lunes … 6=domingo
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programaciones');
    }
};
