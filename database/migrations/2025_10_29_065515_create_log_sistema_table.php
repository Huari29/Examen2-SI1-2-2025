<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_sistema', function (Blueprint $table) {
            $table->id('id_log'); // SERIAL PK
            $table->foreignId('id_usuario')->nullable()->constrained('usuario', 'id_usuario'); // FK opcional -> usuario(id_usuario)
            $table->string('modulo', 100); // NOT NULL, ej. 'Horario','Asistencia'
            $table->string('accion', 50); // NOT NULL, 'CREAR','ACTUALIZAR','ELIMINAR','LOGIN','LOGOUT'
            $table->text('descripcion')->nullable(); // NULL
            $table->string('ip', 50)->nullable(); // NULL
            $table->string('navegador', 250)->nullable(); // NULL
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_sistema');
    }
};
