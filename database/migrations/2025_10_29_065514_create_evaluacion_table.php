<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluacion', function (Blueprint $table) {
            $table->id('id_evaluacion'); // SERIAL PK
            $table->foreignId('id_docente')->constrained('usuario', 'id_usuario'); // FK -> usuario(id_usuario)
            $table->decimal('porcentaje', 5, 2); // NOT NULL
            $table->string('gestion', 20)->nullable(); // NULL
            $table->foreignId('evaluado_por')->nullable()->constrained('usuario', 'id_usuario'); // FK opcional -> usuario(id_usuario)
            $table->text('observacion')->nullable(); // NULL
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluacion');
    }
};
