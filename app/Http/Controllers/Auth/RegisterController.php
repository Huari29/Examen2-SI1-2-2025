<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('livewire.auth.register'); // tu vista de registro
    }

    public function store(Request $request)
    {
        $user = app(CreateNewUser::class)->create($request->all());

        return redirect()->route('dashboard');
    }
}
