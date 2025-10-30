<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->string('clave', 100)->primary(); // VARCHAR PK
            $table->text('valor')->nullable(); // NULL
            $table->text('descripcion')->nullable(); // NULL
            $table->timestampTz('actualizado_en')->nullable(); // NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};
