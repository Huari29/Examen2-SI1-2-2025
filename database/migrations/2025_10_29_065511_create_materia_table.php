<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materia', function (Blueprint $table) {
            $table->id('id_materia'); // SERIAL PK
            $table->string('codigo', 30)->unique(); // NOT NULL UNIQUE
            $table->string('nombre', 150); // NOT NULL
            $table->integer('carga_horaria')->default(0); // NOT NULL DEFAULT 0
            $table->string('gestion_default', 20)->nullable(); // NULL, ej. '2025-1'
            $table->boolean('activo')->default(true); // NOT NULL DEFAULT TRUE
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
            $table->timestampTz('actualizado_en')->nullable(); // NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materia');
    }
};
