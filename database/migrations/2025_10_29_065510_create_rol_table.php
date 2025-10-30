<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->id('id_rol'); // SERIAL PK
            $table->string('nombre', 50)->unique(); // NOT NULL UNIQUE
            $table->text('descripcion')->nullable(); // NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rol');
    }
};
