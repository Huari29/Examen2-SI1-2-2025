<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->id('id_horario'); // SERIAL PK
            $table->time('hora_inicio'); // NOT NULL
            $table->time('hora_fin'); // NOT NULL
            $table->string('descripcion', 80)->nullable(); // NULL
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horario');
    }
};
