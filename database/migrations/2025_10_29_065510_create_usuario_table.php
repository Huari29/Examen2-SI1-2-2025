<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario'); // SERIAL PK
            $table->string('nombre', 150); // NOT NULL
            $table->string('correo', 150)->unique(); // NOT NULL UNIQUE
            $table->string('contrasenia', 255); // NOT NULL
            $table->foreignId('id_rol')->constrained('rol', 'id_rol'); // FK -> rol(id_rol)
            $table->boolean('activo')->default(true); // NOT NULL DEFAULT TRUE
            $table->timestampTz('creado_en')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
            $table->timestampTz('actualizado_en')->nullable(); // NULL
            $table->timestampTz('ultimo_login')->nullable(); // NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
