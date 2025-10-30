<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id('id_asistencia'); // SERIAL PK
            $table->foreignId('id_detalle')->constrained('detalle_horario', 'id_detalle'); // FK -> detalle_horario(id_detalle)
            $table->date('fecha'); // NOT NULL
            $table->string('estado', 20); // NOT NULL, 'Presente','Ausente','Justificado'
            $table->string('metodo_registro', 20)->nullable(); // NULL, 'QR','Manual'
            $table->foreignId('registrado_por')->nullable()->constrained('usuario', 'id_usuario'); // FK opcional -> usuario(id_usuario)
            $table->text('observacion')->nullable(); // NULL
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};
