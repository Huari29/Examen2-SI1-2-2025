<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

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
