<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materia_grupo', function (Blueprint $table) {
            $table->id('id_mg'); // SERIAL PK
            $table->foreignId('id_materia')->constrained('materia', 'id_materia'); // FK -> materia(id_materia)
            $table->foreignId('id_grupo')->constrained('grupo', 'id_grupo'); // FK -> grupo(id_grupo)
            $table->foreignId('id_docente')->nullable()->constrained('usuario', 'id_usuario'); // FK opcional -> usuario(id_usuario)
            $table->string('gestion', 20)->nullable(); // NULL, ej. '2025-1'
            $table->boolean('activo')->default(true); // NOT NULL DEFAULT TRUE
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materia_grupo');
    }
};
