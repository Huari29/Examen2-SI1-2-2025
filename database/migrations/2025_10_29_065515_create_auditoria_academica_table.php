<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auditoria_academica', function (Blueprint $table) {
            $table->id('id_auditoria'); // SERIAL PK
            $table->foreignId('id_solicitante')->constrained('usuario', 'id_usuario'); // FK -> usuario(id_usuario)
            $table->text('descripcion'); // NOT NULL
            $table->timestampTz('fecha_solicitud')->useCurrent(); // TIMESTAMP WITH TIME ZONE DEFAULT now()
            $table->string('estado', 20)->default('pendiente'); // NOT NULL DEFAULT 'pendiente'
            $table->foreignId('atendido_por')->nullable()->constrained('usuario', 'id_usuario'); // FK opcional -> usuario(id_usuario)
            $table->text('respuesta')->nullable(); // NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auditoria_academica');
    }
};
