<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->id('id_grupo'); // SERIAL PK
            $table->string('codigo', 30); // NOT NULL, ej. 'N1', 'NX'
            $table->string('nombre', 100)->nullable(); // NULL
            $table->string('turno', 30)->nullable(); // NULL, mañana/tarde/noche
            $table->string('gestion', 20)->nullable(); // NULL
            $table->boolean('activo')->default(true); // NOT NULL DEFAULT TRUE
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupo');
    }
};

