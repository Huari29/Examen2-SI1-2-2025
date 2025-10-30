<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rol')->insert([
            [
                'nombre' => 'Autoridad',
                'descripcion' => 'Usuario encargado de la gestión de grupos y aulas',
            ],
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Usuario con todos los permisos del sistema',
            ],
            [
                'nombre' => 'Docente',
                'descripcion' => 'Usuario que imparte materias y registra asistencia',
            ],
        ]);
    }
}
