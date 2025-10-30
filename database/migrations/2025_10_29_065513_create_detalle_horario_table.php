<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_horario', function (Blueprint $table) {
            $table->id('id_detalle'); // SERIAL PK
            $table->foreignId('id_mg')->constrained('materia_grupo', 'id_mg'); // FK -> materia_grupo(id_mg)
            $table->foreignId('id_aula')->constrained('aula', 'id_aula'); // FK -> aula(id_aula)
            $table->foreignId('id_horario')->constrained('horario', 'id_horario'); // FK -> horario(id_horario)
            $table->string('dia_semana', 15); // NOT NULL, 'Lunes','Martes',...
            $table->string('gestion', 20)->nullable(); // NULL
            $table->string('estado', 20)->default('activo'); // NOT NULL DEFAULT 'activo'
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_horario');
    }
};
