<?php

namespace App\Actions\Fortify;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Valida, crea y loguea un nuevo usuario.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Usuario
    {
        // Validación
        Validator::make($input, [
            'nombre' => ['required', 'string', 'max:150'],
            'correo' => [
                'required',
                'string',
                'email',
                'max:150',
                Rule::unique(Usuario::class, 'correo'),
            ],
            'contrasenia' => $this->passwordRules(),
            //'id_rol' => ['required', 'exists:rol,id_rol'],
        ])->validate();

        // Crear usuario
        $user = Usuario::create([
            'nombre' => $input['nombre'],
            'correo' => $input['correo'],
            'contrasenia' => Hash::make($input['contrasenia']),
            'id_rol' => $input['id_rol'] ?? 3, // Por defecto 3 si no se envía
            'activo' => true,
            'creado_en' => now(),
        ]);

        // Loguear automáticamente
        Auth::login($user);

        // Redirigir al dashboard
        return $user;
    }
}
