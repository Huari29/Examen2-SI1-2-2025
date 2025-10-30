<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aula', function (Blueprint $table) {
            $table->id('id_aula'); // SERIAL PK
            $table->string('codigo', 50)->unique(); // NOT NULL UNIQUE, ej. 'A-12'
            $table->string('nombre', 100)->nullable(); // NULL
            $table->integer('capacidad')->nullable(); // NULL
            $table->string('ubicacion', 150)->nullable(); // NULL
            $table->boolean('activo')->default(true); // NOT NULL DEFAULT TRUE
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aula');
    }
};
